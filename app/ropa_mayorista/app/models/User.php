<?php
require_once dirname(__DIR__) . '/core/Model.php';

class User extends Model {
    
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT u.*, r.nombre as rol_nombre FROM usuarios u JOIN roles r ON u.id_rol = r.id_rol WHERE u.correo = :correo LIMIT 1");
        $stmt->bindParam(':correo', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function createUser($data) {
        try {
            // El rol por defecto para un registro desde la web es 'Cliente' (ID 3, según nuestro seed)
            $rol_id = 3; 
            
            $stmt = $this->db->prepare("INSERT INTO usuarios (id_rol, nombre, apellido, correo, telefono, password_hash) VALUES (:id_rol, :nombre, :apellido, :correo, :telefono, :password_hash)");
            $stmt->bindParam(':id_rol', $rol_id);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':apellido', $data['apellido']);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':telefono', $data['telefono']);
            
            // Hash de la contraseña (OWASP recomendación)
            $hash = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password_hash', $hash);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            // Manejar error (ej: correo duplicado)
            error_log("Error creando usuario: " . $e->getMessage());
            return false;
        }
    }
}
