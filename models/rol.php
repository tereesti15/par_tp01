<?php

require_once("config/database.php");

class Rol {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }
	
	// Listar los roles
    public function listarRol() {
        $sql = "SELECT * FROM v_lista_rol";
        $stmt = $this->pdo->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	  
    }
}
?>