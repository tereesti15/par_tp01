<?php

require_once("config/database.php");

class Departamento {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Listar todos los departamentos (verificado)
    public function listarDepartamento() {
        $sql = "SELECT * FROM v_lista_departamento";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	// Insertar un nuevo departamento (verificado)
	public function insertarDepartamento($nombre_departamento, $ubicacion) {
        $sql = $this->pdo->prepare("CALL insertar_departamento('" . $nombre_departamento . "','" . $ubicacion ."',  @p_id )");//los campos deben coincidir con los campos que se le pasa a la función
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		$result = $this->pdo->query("SELECT @p_id AS departamento_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['departamento_id'] ?? false;
		
    }
	
	// Actualizar un departamento existente (verificado)
    public function actualizarDepartamento($id_departamento, $nombre_departamento, $ubicacion) {
        $sql = $this->pdo->prepare("CALL actualizar_departamento(" . $id_departamento . ", '" . $nombre_departamento . "','" . $ubicacion ."',  @p_id )");
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		$result = $this->pdo->query("SELECT @p_id AS departamento_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['departamento_id'] ?? false;
    }
	
	
	//Borrar departamento (verificado)
	public function borrarDepartamento($id_departamento) {
       
		$sql = $this->pdo->prepare("CALL borrar_departamento(" . $id_departamento . ",  @p_id )");
       
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		$result = $this->pdo->query("SELECT @p_id AS departamento_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['departamento_id'] ?? false;
    }
	
	
}
?>
