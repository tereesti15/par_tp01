<?php

//require_once(realpath(dirname(__FILE__))."\models\persona.php");
require_once("models/Persona.php");

//require_once(realpath(dirname(__FILE__) . '/models/Persona.php'));

class PersonaController {
    private $personaModel;

    public function __construct() {
        $this->personaModel = new Persona();
    }

    
   /* public function index() {
        $personas = $this->personaModel->listarPersona();
        require_once("views/listar_personas.php");
    }*/
	
	// Mostrar la lista de persona
	public function index() {
        $persona = $this->personaModel->listarPersona();
        $personaArray = [];

		$rows = $persona;
		foreach ($rows as $row) {
			$personaArray[] = $row;
		}

        header('Content-Type: application/json');
        echo json_encode(["exito" => true, "dato" => $personaArray]);
    }

    // Mostrar el formulario para modificar una persona (no usar)
    public function modificar() {
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			$id = $_GET['id'];
			$persona = $this->personaModel->obtenerPersona($id);
			require_once("views/v_persona.php");
		}
    }

    // Guardar cambios en una persona
    public function guardarModificacion() { 
		if ($_SERVER["REQUEST_METHOD"] == "PUT") {
			//$data = json_decode(file_get_contents("php://input"));
			//parse_str(file_get_contents('php://input'), $_PATCH);
			$json = file_get_contents('php://input');
			$datos = json_decode($json, true);
			$id = $datos["id"] ?? null;
            $nombre = $datos["nombre"] ?? null;
            $apellido = $datos["apellido"] ?? null;
           // $documento = $datos['documento'] ?? null;
			$direccion = $datos["direccion"] ?? null;
			$telefono = $datos["telefono"] ?? null;
			//$email = $_PATCH['email'] ?? null;

            if ($nombre && $apellido && $direccion && $telefono) {
                $resultado = $this->personaModel->actualizarPersona($id, $nombre, $apellido, $direccion, $telefono);
                 if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Persona actualizada correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al actualizar persona"]);
                } 
			} else {
				header('Content-Type: application/json', true, 400);
				echo json_encode(["success" => false, "message" => "Datos incompletos"]);
				
                //exit();
			}
			
        }
		
    }

    // Mostrar el formulario para agregar una nueva persona
    public function agregar() {
        require_once("views/v_persona.php");
    }

    // Insertar una nueva persona (no tocar)
    public function guardarNuevo($nombre, $apellido, $documento, $direccion, $telefono, $email) {
        $this->personaModel->insertarPersona($nombre, $apellido, $documento, $direccion, $telefono, $email);
        //header("Location: /mvc/public/index.php?action=listar");
        //exit();
    }
	
	//Guarda nueva persona
	public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);

            $nombre = $_POST['nombre'] ?? null;
            $apellido = $_POST['apellido'] ?? null;
            $documento = $_POST['documento'] ?? null;
			$direccion = $_POST['direccion'] ?? null;
			$telefono = $_POST['telefono'] ?? null;
			$email = $_POST['email'] ?? null;

            if ($nombre && $apellido && $documento && $direccion && $telefono && $email) {
                $resultado = $this->personaModel->insertarPersona($nombre, $apellido, $documento, $direccion, $telefono, $email);

                if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Persona guardada correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al guardar persona"]);
                }
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(["success" => false, "message" => "Datos incompletos"]);
            }
        }
    }
	
	// Borrar persona
	public function borrar() {
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $json = file_get_contents('php://input');
			$datos = json_decode($json, true);
			$id = $datos["id"] ?? null;

            if ($id) {
                $resultado = $this->personaModel->borrarPersona($id);
                 if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Persona borrada correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al borrar persona"]);
                } 
			} else {
				header('Content-Type: application/json', true, 400);
				echo json_encode(["success" => false, "message" => "Datos incompletos"]);
				
                //exit();
			}
        }
    }
}
?>
