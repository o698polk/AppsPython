<?php
require_once dirname(__DIR__) . '/core/Model.php';

class Product extends Model {
    
    public function getAll() {
        $stmt = $this->db->query("
            SELECT p.*, c.nombre as categoria_nombre 
            FROM productos p 
            LEFT JOIN categorias c ON p.id_categoria = c.id_categoria 
            ORDER BY p.id_producto DESC
        ");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id_producto = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO productos (id_categoria, nombre, sku, descripcion, precio_mayorista, stock, estado, img_principal, telefono_vendedor) 
            VALUES (:id_categoria, :nombre, :sku, :descripcion, :precio_mayorista, :stock, :estado, :img_principal, :telefono_vendedor)
        ");
        return $stmt->execute([
            'id_categoria' => $data['id_categoria'],
            'nombre' => $data['nombre'],
            'sku' => $data['sku'],
            'descripcion' => $data['descripcion'],
            'precio_mayorista' => $data['precio_mayorista'],
            'stock' => $data['stock'],
            'estado' => $data['estado'] ?? 1,
            'img_principal' => $data['img_principal'] ?? 'default.jpg',
            'telefono_vendedor' => $data['telefono_vendedor']
        ]);
    }

    public function update($id, $data) {
        // Solo actualizamos la imagen si se subió una nueva
        $imgSql = isset($data['img_principal']) ? ", img_principal = :img_principal" : "";
        
        $sql = "UPDATE productos SET 
                id_categoria = :id_categoria, 
                nombre = :nombre, 
                sku = :sku, 
                descripcion = :descripcion, 
                precio_mayorista = :precio_mayorista, 
                stock = :stock, 
                estado = :estado, 
                telefono_vendedor = :telefono_vendedor
                $imgSql 
                WHERE id_producto = :id";
                
        $params = [
            'id_categoria' => $data['id_categoria'],
            'nombre' => $data['nombre'],
            'sku' => $data['sku'],
            'descripcion' => $data['descripcion'],
            'precio_mayorista' => $data['precio_mayorista'],
            'stock' => $data['stock'],
            'estado' => $data['estado'],
            'telefono_vendedor' => $data['telefono_vendedor'],
            'id' => $id
        ];

        if (isset($data['img_principal'])) {
            $params['img_principal'] = $data['img_principal'];
        }

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id_producto = :id");
        return $stmt->execute(['id' => $id]);
    }
}
