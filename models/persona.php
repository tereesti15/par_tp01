<?php

require_once("config/database.php");

class Persona {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Listar todas las personas
    public function listarPersona() {
        $sql = "SELECT * FROM v_lista_persona";
        $stmt = $this->pdo->query($sql);
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
	   //return $this->pdo->query($sql);
    }

    // Obtener una persona por id
    public function obtenerPersona($id) {
        $sql = "SELECT * FROM v_lista_persona WHERE ID_Persona = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insertar una nueva persona
    public function insertarPersona($nombre, $apellido, $documento, $direccion, $telefono, $email) {
        $sql = $this->pdo->prepare("CALL insertar_persona('" . $nombre . "','" . $apellido ."','" . $documento . "','" . $direccion . "','" . $telefono . "','" . $email . "',  @p_id )");
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		//$sql->close();

		//return $resultado;
		$result = $this->pdo->query("SELECT @p_id AS persona_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['persona_id'] ?? false;
		
    }
	

    // Actualizar una persona existente
    public function actualizarPersona($id, $nombre, $apellido, $direccion, $telefono) {
       // $sql = "UPDATE persona SET nombre = :nombre, apellido = :apellido, documento = :documento, direccion =:direccion, telefono = :telefono, email = :email WHERE id_persona = :id";
	    $sql = $this->pdo->prepare("CALL actualizar_persona(" . $id . ", '" . $nombre . "','" . $apellido ."','" . $direccion . "','" . $telefono . "',  @p_id )");
		
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		//$sql->close();

		//return $resultado;
		$result = $this->pdo->query("SELECT @p_id AS persona_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['persona_id'] ?? false;
    }
	
	// Borrar persona por id
    public function borrarPersona($id) {
       /* $sql = "DELETE FROM persona WHERE ID_Persona = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);*/
		$sql = $this->pdo->prepare("CALL borrar_persona(" . $id . ",  @p_id )");
       
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		//$sql->close();

		//return $resultado;
		$result = $this->pdo->query("SELECT @p_id AS persona_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['persona_id'] ?? false;
    }
}
?>