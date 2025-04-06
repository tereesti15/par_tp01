<?php

require_once("config/database.php");

class Cargo {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }
	
	// Listar los cargos (verificado)
    public function listarCargo() {
        $sql = "SELECT * FROM v_lista_cargo";
        $stmt = $this->pdo->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	  
    }
	
	// Insertar un nuevo cargo (verificado)
	public function insertarCargo($nombre_cargo, $descripcion, $salario) {
        $sql = $this->pdo->prepare("CALL insertar_cargo('" . $nombre_cargo . "','" . $descripcion ."'," . $salario . ",  @p_id )");//los campos deben coincidir con los campos que se le pasa a la función
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		$result = $this->pdo->query("SELECT @p_id AS cargo_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['cargo_id'] ?? false;
		
    }
	
	// Actualizar un cargo existente (verificado)
    public function actualizarCargo($id_cargo, $nombre_cargo, $descripcion, $salario) {
        $sql = $this->pdo->prepare("CALL actualizar_cargo(" . $id_cargo . ", '" . $nombre_cargo . "','" . $descripcion ."'," . $salario . ",  @p_id )");
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		$result = $this->pdo->query("SELECT @p_id AS cargo_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['cargo_id'] ?? false;
    }
	
	//Borrar departamento (verificado)
	public function borrarCargo($id_cargo) {
		$sql = $this->pdo->prepare("CALL borrar_cargo(" . $id_cargo . ",  @p_id )");
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		$result = $this->pdo->query("SELECT @p_id AS cargo_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['cargo_id'] ?? false;
    }
}
?>