<?php

require_once("models/Cargo.php");

class CargoController {
    private $cargoModel;

    public function __construct() {
        $this->cargoModel = new Cargo();
    }

	
	// Mostrar la lista de cargos (verificado)
	public function index() {
        $cargo = $this->cargoModel->listarCargo();
        $cargoArray = [];

		$rows = $cargo;
		foreach ($rows as $row) {
			$cargoArray[] = $row;
		}

        header('Content-Type: application/json');
        echo json_encode(["exito" => true, "dato" => $cargoArray]);
    }
	
	
	//Agrega un nuevo cargo (verificado)
	public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
			
            $nombre_cargo = $_POST['nombre_cargo'] ?? null;
            $descripcion = $_POST['descripcion'] ?? null;
            $salario = $_POST['salario'] ?? null;

            if ($nombre_cargo && $descripcion && $salario) {
                $resultado = $this->cargoModel->insertarCargo($nombre_cargo, $descripcion, $salario); //invoca al modelo 

                if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Cargo guardado correctamente", "id_cargo" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al guardar el cargo"]);
                }
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(["success" => false, "message" => "Datos incompletos"]);
            }
        }
    }
	
	
	// Modificar cargo (verificado)
    public function guardarModificacion() { 
		if ($_SERVER["REQUEST_METHOD"] == "PUT") {
			
			$json = file_get_contents('php://input');
			$datos = json_decode($json, true);
			$id_cargo = $datos['id_cargo'] ?? null;
            $nombre_cargo = $datos['nombre_cargo'] ?? null;
            $descripcion = $datos['descripcion'] ?? null;
			$salario = $datos['salario'] ?? null;


            if ($id_cargo && $nombre_cargo && $descripcion &&  $salario) {
                $resultado = $this->cargoModel->actualizarCargo($id_cargo, $nombre_cargo, $descripcion, $salario);
				if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Cargo actualizado correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al actualizar cargo"]);
                } 
            } else {
				header('Content-Type: application/json', true, 400);
				echo json_encode(["success" => false, "message" => "Datos incompletos"]);
			
			}
        }
	}

	
	// Borrar cargo (verificado)
	public function borrarCargo() {
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $json = file_get_contents('php://input');
			$datos = json_decode($json, true);
			$id_cargo = $datos["id_cargo"] ?? null;

            if ($id_cargo) {
                $resultado = $this->cargoModel->borrarCargo($id_cargo);
                 if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Cargo borrado correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al borrar cargo"]);
                } 
			} else {
				header('Content-Type: application/json', true, 400);
				echo json_encode(["success" => false, "message" => "Datos incompletos"]);
			}
        }
    }
	
   
}
?>
