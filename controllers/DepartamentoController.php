<?php

require_once("models/Departamento.php");

class DepartamentoController {
    private $departamentoModel;

    public function __construct() {
        $this->departamentoModel = new Departamento();
    }

	
	// Mostrar la lista de departamentos (verificado)
	public function index() {
        $departamento = $this->departamentoModel->listarDepartamento();
        $departamentoArray = [];

		$rows = $departamento;
		foreach ($rows as $row) {
			$departamentoArray[] = $row;
		}

        header('Content-Type: application/json');
        echo json_encode(["exito" => true, "dato" => $departamentoArray]);
    }
	
	
	//Agrega un nuevo departamento (verificado)
	public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
			
            $nombre_departamento = $_POST['nombre_departamento'] ?? null;
            $ubicacion = $_POST['ubicacion'] ?? null;

            if ($nombre_departamento && $ubicacion) {
                $resultado = $this->departamentoModel->insertarDepartamento($nombre_departamento, $ubicacion); //invoca al modelo 

                if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Departamento guardado correctamente", "id_departamento" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al guardar el departamento"]);
                }
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(["success" => false, "message" => "Datos incompletos"]);
            }
        }
    }
	
	
	// Modificar departamento (verificado)
    public function guardarModificacion() { 
		if ($_SERVER["REQUEST_METHOD"] == "PUT") {
			
			$json = file_get_contents('php://input');
			$datos = json_decode($json, true);
			$id_departamento = $datos['id_departamento'] ?? null;
            $nombre_departamento = $datos['nombre_departamento'] ?? null;
            $ubicacion = $datos['ubicacion'] ?? null;


            if ($id_departamento && $nombre_departamento && $ubicacion) {
                $resultado = $this->departamentoModel->actualizarDepartamento($id_departamento, $nombre_departamento, $ubicacion);
				if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Departamento actualizado correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al actualizar departamento"]);
                } 
            } else {
				header('Content-Type: application/json', true, 400);
				echo json_encode(["success" => false, "message" => "Datos incompletos"]);
			
			}
        }
	}

	
	// Borrar departamento (verificado)
	public function borrarDepartamento() {
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $json = file_get_contents('php://input');
			$datos = json_decode($json, true);
			$id_departamento = $datos["id_departamento"] ?? null;

            if ($id_departamento) {
                $resultado = $this->departamentoModel->borrarDepartamento($id_departamento);
                 if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "departamento borrado correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al borrar departamento"]);
                } 
			} else {
				header('Content-Type: application/json', true, 400);
				echo json_encode(["success" => false, "message" => "Datos incompletos"]);
			}
        }
    }
	
   
}
?>
