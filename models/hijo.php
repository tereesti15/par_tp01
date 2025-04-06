<?php

require_once("config/database.php");

class Hijo {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Listar todos los hijos (controlar)
    public function listarHijos() {
        $sql = "SELECT * FROM hijo";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	// Lista de hijos por padre (controlar)
	public function getAllWithChildren() {
        $personas = [];
        $sql = "SELECT * FROM v_hijo_x_padre";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
		foreach ($result as $row) {
            $persona_id = $row['ID_Persona'];

            if (!isset($personas[$persona_id])) {
                $personas[$persona_id] = [
                    "id" => $persona_id,
                    "nombre" => $row['Nombre'],
                    "apellido" => $row['Apellido'],
                    "hijos" => []
                ];
            }

            if ($row['ID_Hijo'] !== null) {
                $personas[$persona_id]["hijos"][] = [
                    "id_hijo" => $row['ID_Hijo'],
                    "nombre_hijo" => $row['Nombre_hijo'],
                    "fecha_nacimiento_hijo" => $row['Fecha_Nacimiento']
                ];
            }
        }
		
		//$result = $this->pdo->query($sql);
		/*
		
        while ($row = $result->fetch_assoc()) {
            $persona_id = $row['ID_Persona'];

            if (!isset($personas[$persona_id])) {
                $personas[$persona_id] = [
                    "id" => $persona_id,
                    "nombre" => $row['Nombre'],
                    "apellido" => $row['Apellido'],
                    "hijos" => []
                ];
            }

            if ($row['ID_Hijo'] !== null) {
                $personas[$persona_id]["hijos"][] = [
                    "id_hijo" => $row['ID_Hijo'],
                    "nombre_hijo" => $row['Nombre_hijo'],
                    "fecha_nacimiento_hijo" => $row['Fecha_Nacimiento']
                ];
            }
        }*/

        return array_values($personas); // Reindexa el array para JSON
    }

    // Obtener un hijo por persona(id) (verificado)
    public function obtenerHijo($id) {
        $sql = "SELECT * FROM hijo WHERE ID_Hijo = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
		//return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	//Obtiene un listado de hijos por padre (verificado)
	public function obtenerHijoPorPadre($id) {
        $sql = "SELECT * FROM hijo WHERE ID_Persona = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        //return $stmt->fetch(PDO::FETCH_ASSOC);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	// Obtener cantidad de hijos por persona(id)(controlar)
    public function obtenerCantidadHijoPorPersona($id) {
        $sql = "SELECT * FROM v_hijo_x_persona WHERE id_per = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insertar un nuevo hijo (código a reciclar)
   /* public function insertarHijo($idPersona, $Nombre, $fechaNacimiento) {
        $sql = "INSERT INTO hijo (ID_Persona, Nombre, Fecha_Nacimiento) 
		VALUES (:id_persona, :nombre, :fecha_nacimiento)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_persona' => $idPersona,
            ':nombre' => $Nombre,
            ':fecha_nacimiento' => $fechaNacimiento
        ]);
    }*/
	
	// Insertar un nuevo hijo (verificado)
	public function insertarHijo($idPersona, $Nombre, $fechaNacimiento, $documento) {
        $sql = $this->pdo->prepare("CALL insertar_hijo(" . $idPersona . ",'" . $Nombre ."','" . $fechaNacimiento . "','" . $documento . "',  @p_id )");
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		//$sql->close();

		//return $resultado;
		$result = $this->pdo->query("SELECT @p_id AS hijo_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['hijo_id'] ?? false;
		
    }
	

    // Actualizar un hijo existente (verificado)
    public function actualizarHijo($id, $nombre, $fechaNacimiento, $documento) {
        $sql = $this->pdo->prepare("CALL actualizar_hijo(" . $id . ", '" . $nombre . "','" . $documento ."','" . $fechaNacimiento . "',  @p_id )");
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		//$sql->close();

		//return $resultado;
		$result = $this->pdo->query("SELECT @p_id AS hijo_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['hijo_id'] ?? false;
    }
	
	
	
	//Borrar hijo (verificado)
	public function borrarHijo($ID_Hijo) {
       
		$sql = $this->pdo->prepare("CALL borrar_hijo(" . $ID_Hijo . ",  @p_id )");
       
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		
		$result = $this->pdo->query("SELECT @p_id AS hijo_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['hijo_id'] ?? false;
    }
	
	//Borrar todos los hijos de un padre (verificado)
	public function borrarHijosPorPadre($id_padre) {
       
		$sql = $this->pdo->prepare("CALL borrar_hijos_por_padre(" . $id_padre . ",  @p_id )");
       
		if (!$sql){
            return false; // Fallo en la preparación
        }
		
		$resultado = $sql->execute();
		
		$result = $this->pdo->query("SELECT @p_id AS hijo_id");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		return $row['hijo_id'] ?? false;
    }
	
	
	
	
}
?>