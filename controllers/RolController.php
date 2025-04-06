<?php

require_once("models/rol.php");

class RolController {
    private $rolModel;

    public function __construct() {
        $this->rolModel = new Rol();
    }

	// Mostrar la lista de cargos (verificado)
	public function index() {
        $rol = $this->rolModel->listarRol();
        $rolArray = [];

		$rows = $rol;
		foreach ($rows as $row) {
			$rolArray[] = $row;
		}

        header('Content-Type: application/json');
        echo json_encode(["exito" => true, "dato" => $rolArray]);
    }
	
}
?>
