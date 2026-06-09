<?php
class WhatsAppHelper {
    /**
     * Genera un enlace de WhatsApp con un mensaje predefinido
     * @param string $telefono Número del vendedor (debe incluir código de país sin +)
     * @param array $producto Datos del producto para armar el mensaje
     * @return string URL de la API de WhatsApp
     */
    public static function generateLink($telefono, $producto) {
        // Formatear el número (quitar espacios, símbolos y +, si los hubiera)
        $telefonoLimpio = preg_replace('/[^0-9]/', '', $telefono);

        // Armar el mensaje base
        $mensaje = "Hola, estoy interesado en el siguiente producto:\n\n";
        $mensaje .= "🧥 *Producto:* " . $producto['nombre'] . "\n";
        $mensaje .= "🔖 *SKU:* " . $producto['sku'] . "\n";
        $mensaje .= "💰 *Precio Mayorista:* $" . number_format($producto['precio_mayorista'], 2) . "\n\n";
        $mensaje .= "Quisiera recibir más información sobre el proceso de compra.";

        // Codificar el texto para URL
        $mensajeCodificado = rawurlencode($mensaje);

        // Retornar la URL final
        return "https://wa.me/{$telefonoLimpio}?text={$mensajeCodificado}";
    }
}
