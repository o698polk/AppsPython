<?php
require_once dirname(__DIR__) . '/core/Model.php';

class Category extends Model {
    
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM categorias ORDER BY nombre ASC");
        return $stmt->fetchAll();
    }

    public function getActive() {
        $stmt = $this->db->query("SELECT * FROM categorias WHERE estado = 1 ORDER BY nombre ASC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categorias WHERE id_categoria = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO categorias (nombre, descripcion, estado) VALUES (:nombre, :descripcion, :estado)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'estado' => $data['estado'] ?? 1
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE categorias SET nombre = :nombre, descripcion = :descripcion, estado = :estado WHERE id_categoria = :id");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'estado' => $data['estado'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        // En un sistema real se valida si hay productos asociados antes de borrar
        $stmt = $this->db->prepare("DELETE FROM categorias WHERE id_categoria = :id");
        return $stmt->execute(['id' => $id]);
    }
}
