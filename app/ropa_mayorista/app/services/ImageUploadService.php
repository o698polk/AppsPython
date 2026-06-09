<?php
class ImageUploadService {
    private $targetDir;
    private $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    private $maxSize = 2 * 1024 * 1024; // 2MB

    public function __construct() {
        $this->targetDir = dirname(__DIR__, 2) . '/public/images/products/';
        if (!file_exists($this->targetDir)) {
            mkdir($this->targetDir, 0777, true);
        }
    }

    public function upload($fileInputName) {
        if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $file = $_FILES[$fileInputName];

        // Validaciones de seguridad (OWASP)
        if (!in_array($file['type'], $this->allowedTypes)) {
            throw new Exception("Tipo de archivo no permitido. Solo JPG, PNG o WEBP.");
        }

        if ($file['size'] > $this->maxSize) {
            throw new Exception("La imagen excede el tamaño máximo permitido de 2MB.");
        }

        // Generar nombre seguro
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $safeName = uniqid('prod_') . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
        $targetPath = $this->targetDir . $safeName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $safeName;
        }

        throw new Exception("Error al guardar la imagen en el servidor.");
    }
}
