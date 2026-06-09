// ==========================================
// Archivo: app.js
// Propósito: Lógica del Cliente para interactuar con la API RESTful de FastAPI usando Fetch API.
// ==========================================

// URL base de la API del servidor local
const API_URL = 'http://127.0.0.1:8000/productos/';

// Referencias a elementos del DOM (Document Object Model)
const formulario = document.getElementById('producto-form');
const tablaProductos = document.getElementById('tabla-productos');
const formTitle = document.getElementById('form-title');
const btnCancelar = document.getElementById('btn-cancelar');

// Evento que se ejecuta cuando el documento HTML ha cargado completamente
document.addEventListener('DOMContentLoaded', () => {
    cargarProductos(); // Cargar la tabla al inicio
});

// Evento para escuchar el envío del formulario (Crear o Actualizar)
formulario.addEventListener('submit', async (e) => {
    e.preventDefault(); // Evita que la página se recargue

    // Obtener los valores de los inputs
    const id = document.getElementById('producto-id').value;
    const nombre = document.getElementById('nombre').value;
    const descripcion = document.getElementById('descripcion').value;
    const precio = parseFloat(document.getElementById('precio').value);
    const cantidad = parseInt(document.getElementById('cantidad').value);

    // Crear un objeto de JavaScript con los datos a enviar
    const productoData = {
        nombre: nombre,
        descripcion: descripcion,
        precio: precio,
        cantidad: cantidad
    };

    if (id) {
        // Si hay un ID, significa que estamos editando un producto existente
        await actualizarProducto(id, productoData);
    } else {
        // Si no hay ID, creamos un nuevo producto
        await crearProducto(productoData);
    }

    // Limpiar el formulario y recargar la tabla
    formulario.reset();
    document.getElementById('producto-id').value = '';
    formTitle.textContent = 'Añadir Producto';
    btnCancelar.classList.add('d-none');
    cargarProductos();
});

// ==========================================
// FUNCIONES PARA CONSUMIR LA API
// ==========================================

// Función para Leer/Obtener todos los productos (GET)
async function cargarProductos() {
    try {
        // Fetch hace una petición HTTP GET por defecto
        const respuesta = await fetch(API_URL);
        const productos = await respuesta.json(); // Convierte la respuesta a formato JSON (Array de objetos)

        // Limpiar el contenido actual de la tabla
        tablaProductos.innerHTML = '';

        // Recorrer el array de productos y crear las filas HTML
        productos.forEach(producto => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${producto.id}</td>
                <td><strong>${producto.nombre}</strong></td>
                <td>${producto.descripcion || '-'}</td>
                <td>$${producto.precio.toFixed(2)}</td>
                <td>
                    <span class="badge bg-${producto.cantidad > 0 ? 'success' : 'danger'}">
                        ${producto.cantidad}
                    </span>
                </td>
                <td>
                    <!-- Botón para Editar -->
                    <button class="btn btn-sm btn-warning text-white me-1" onclick="prepararEdicion(${producto.id}, '${producto.nombre}', '${producto.descripcion || ''}', ${producto.precio}, ${producto.cantidad})">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <!-- Botón para Eliminar -->
                    <button class="btn btn-sm btn-danger" onclick="eliminarProducto(${producto.id})">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            tablaProductos.appendChild(tr);
        });
    } catch (error) {
        console.error('Error al cargar los productos:', error);
        alert('Hubo un error al conectar con el servidor. ¿Está FastAPI corriendo?');
    }
}

// Función para Crear un producto (POST)
async function crearProducto(productoData) {
    try {
        await fetch(API_URL, {
            method: 'POST', // Método HTTP para crear recursos
            headers: {
                'Content-Type': 'application/json' // Indicamos que enviamos datos en formato JSON
            },
            body: JSON.stringify(productoData) // Convertimos el objeto JS a una cadena JSON
        });
    } catch (error) {
        console.error('Error al crear el producto:', error);
    }
}

// Función para Actualizar un producto (PUT)
async function actualizarProducto(id, productoData) {
    try {
        await fetch(`${API_URL}${id}`, {
            method: 'PUT', // Método HTTP para actualizar/reemplazar recursos
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(productoData)
        });
    } catch (error) {
        console.error('Error al actualizar el producto:', error);
    }
}

// Función para Eliminar un producto (DELETE)
async function eliminarProducto(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        try {
            await fetch(`${API_URL}${id}`, {
                method: 'DELETE' // Método HTTP para eliminar recursos
            });
            cargarProductos(); // Recargamos la tabla tras eliminar
        } catch (error) {
            console.error('Error al eliminar el producto:', error);
        }
    }
}

// ==========================================
// FUNCIONES DE UTILIDAD PARA LA INTERFAZ
// ==========================================

// Prepara el formulario con los datos del producto seleccionado para edición
function prepararEdicion(id, nombre, descripcion, precio, cantidad) {
    document.getElementById('producto-id').value = id;
    document.getElementById('nombre').value = nombre;
    document.getElementById('descripcion').value = descripcion;
    document.getElementById('precio').value = precio;
    document.getElementById('cantidad').value = cantidad;

    formTitle.textContent = 'Editar Producto';
    btnCancelar.classList.remove('d-none');
    
    // Hace scroll suave hacia el formulario
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Cancela el modo edición y limpia el formulario
function cancelarEdicion() {
    formulario.reset();
    document.getElementById('producto-id').value = '';
    formTitle.textContent = 'Añadir Producto';
    btnCancelar.classList.add('d-none');
}
