<?php
require_once 'Database.php';

class Model {
    protected $db;

    public function __construct() {
        // Inyecta la instancia PDO en todos los modelos que hereden de esta clase
        $this->db = Database::getInstance()->getConnection();
    }
}
