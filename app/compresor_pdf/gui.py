import os
from pathlib import Path
import customtkinter as ctk
from tkinter import filedialog, messagebox
from core import comprimir_pdf, PDFValidationError, PDFCompressionError
import threading

class App(ctk.CTk):
    def __init__(self):
        super().__init__()

        self.title("Compresor PDF")
        self.geometry("500x350")
        self.resizable(False, False)

        # Variables
        self.input_path = ctk.StringVar()
        
        self.setup_ui()

    def setup_ui(self):
        # Titulo
        self.title_label = ctk.CTkLabel(self, text="Compresor de Archivos PDF", font=ctk.CTkFont(size=20, weight="bold"))
        self.title_label.pack(pady=(20, 10))

        # Marco de seleccion
        self.frame_selection = ctk.CTkFrame(self)
        self.frame_selection.pack(pady=20, padx=20, fill="x")

        self.btn_select = ctk.CTkButton(self.frame_selection, text="Seleccionar PDF", command=self.seleccionar_pdf)
        self.btn_select.pack(pady=10, padx=10, side="left")

        self.lbl_path = ctk.CTkLabel(self.frame_selection, textvariable=self.input_path, width=250, anchor="w")
        self.lbl_path.pack(pady=10, padx=10, side="left", fill="x", expand=True)

        # Boton comprimir
        self.btn_compress = ctk.CTkButton(self, text="Comprimir", font=ctk.CTkFont(size=15, weight="bold"), command=self.comprimir_hilo)
        self.btn_compress.pack(pady=20)

        # Label de estado
        self.lbl_status = ctk.CTkLabel(self, text="Esperando archivo...", text_color="gray")
        self.lbl_status.pack(pady=10)

    def seleccionar_pdf(self):
        filepath = filedialog.askopenfilename(
            title="Selecciona un archivo PDF",
            filetypes=(("Archivos PDF", "*.pdf"),)
        )
        if filepath:
            self.input_path.set(filepath)
            self.lbl_status.configure(text="Archivo seleccionado. Listo para comprimir.", text_color="white")

    def comprimir_hilo(self):
        if not self.input_path.get():
            messagebox.showwarning("Atención", "Por favor selecciona un archivo PDF primero.")
            return

        self.btn_compress.configure(state="disabled")
        self.lbl_status.configure(text="Comprimiendo... por favor espera.", text_color="orange")
        
        # Ejecutar en hilo para no bloquear GUI
        threading.Thread(target=self.proceso_compresion, daemon=True).start()

    def proceso_compresion(self):
        input_p = self.input_path.get()
        # Sugerir ruta de salida: mismo directorio, añadiendo _compressed
        in_path_obj = Path(input_p)
        out_p = in_path_obj.with_name(f"{in_path_obj.stem}_compressed{in_path_obj.suffix}")

        try:
            comprimir_pdf(input_p, str(out_p))
            
            # Obtener tamaños para estadisticas
            size_in = in_path_obj.stat().st_size / 1024 / 1024
            size_out = out_p.stat().st_size / 1024 / 1024
            ahorro = 100 - ((size_out / size_in) * 100) if size_in > 0 else 0
            
            msg = f"¡Compresión exitosa!\nGuardado en:\n{out_p.name}\n\nTamaño original: {size_in:.2f} MB\nTamaño nuevo: {size_out:.2f} MB\nAhorro: {ahorro:.1f}%"
            self.after(0, self.mostrar_exito, msg)
            
        except PDFValidationError as e:
            self.after(0, self.mostrar_error, f"Error de validación:\n{e}")
        except PDFCompressionError as e:
            self.after(0, self.mostrar_error, f"Error de compresión:\n{e}")
        except Exception as e:
            self.after(0, self.mostrar_error, f"Error inesperado:\n{e}")

    def mostrar_exito(self, msg):
        self.lbl_status.configure(text="Completado", text_color="green")
        messagebox.showinfo("Éxito", msg)
        self.btn_compress.configure(state="normal")
        self.input_path.set("")

    def mostrar_error(self, msg):
        self.lbl_status.configure(text="Error", text_color="red")
        messagebox.showerror("Error", msg)
        self.btn_compress.configure(state="normal")

if __name__ == "__main__":
    ctk.set_appearance_mode("System")  # Modes: "System" (standard), "Dark", "Light"
    ctk.set_default_color_theme("blue")  # Themes: "blue" (standard), "green", "dark-blue"
    app = App()
    app.mainloop()
