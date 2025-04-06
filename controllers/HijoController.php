<?php

//require_once(realpath(dirname(__FILE__))."\models\persona.php");
require_once("models/hijo.php");
require_once("models/persona.php");

//require_once(realpath(dirname(__FILE__) . '/models/Persona.php'));

class HijoController {
    private $hijoModel;
	private $personaModel;

    public function __construct() {
        $this->hijoModel = new Hijo();
		$this->personaModel = new Persona();
    }

    // Mostrar la lista de persona
   /* public function index() {
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			$id = $_GET['id'] ?? "0";
			$persona = $this->personaModel->obtenerPersona($id);
			$hijos = $this->hijoModel->obtenerHijoPorPadre($id);
			require_once("views/v_listar_hijos.php");
			exit();
		}
    }*/
	
	//Obtiene el listado de hijos de un padre (verificado)
	public function index() {
		
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			$id = $_GET['id'] ?? "0";
			$hijo = $this->hijoModel->obtenerHijoPorPadre($id);
			$hijoArray = [];
			$rows = $hijo;
			foreach ($rows as $row) {
				$hijoArray[] = $row;
			}

			header('Content-Type: application/json');
			echo json_encode(["exito" => true, "dato" => $hijoArray]);
		}
    }
	
	//Obtiene listado de hijos por padres (verificado)
	public function listadoPadresHijos() {
        $personas = $this->hijoModel->getAllWithChildren();

        header('Content-Type: application/json');
        echo json_encode(["success" => true, "data" => $personas]);
    }
	
	//Agrega un nuevo hijo (no tocar invoca la vista)
	public function agregarNuevoHijo() {
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			$id = $_GET['id'] ?? "0";
			$persona = $this->personaModel->obtenerPersona($id);//se debe cambiar a hijoModel? y obtenerHijo?
			$agregarHijo = true;
			require_once("views/v_hijo.php");
			
			//se debe cambiar por esto?
			// public function agregarNuevoHijo($ID_persona, $apellido, $documento, $direccion, $telefono, $email) {
			//	$this->personaModel->insertarPersona($nombre, $apellido, $documento, $direccion, $telefono, $email);
			//}
		}
    }
	
    // Mostrar el formulario para modificar un hijo
    public function modificarHijo() {
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			$id = $_GET['id'];
			$hijo = $this->hijoModel->obtenerHijo($id);
			$persona = $this->personaModel->obtenerPersona($hijo['ID_Persona']);
			require_once("views/v_hijo.php");
		}
    }
	

    // Guardar cambios en un hijo (verificado)
    public function guardarModificacion() { 
		if ($_SERVER["REQUEST_METHOD"] == "PUT") {
			
			$json = file_get_contents('php://input');
			$datos = json_decode($json, true);
			$id_hijo = $datos['id_hijo'] ?? null;
            $nombre = $datos['nombre'] ?? null;
            $fechaNacimiento = $datos['fechaNacimiento'] ?? null;
			$documento = $datos['documento'] ?? null;


            if ($nombre && $fechaNacimiento && $id_hijo && $documento) {
                $resultado = $this->hijoModel->actualizarHijo($id_hijo, $nombre, $fechaNacimiento, $documento);
				if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Hijo actualizado correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al actualizar hijo"]);
                } 
            } else {
				header('Content-Type: application/json', true, 400);
				echo json_encode(["success" => false, "message" => "Datos incompletos"]);
			
			}
        }
	
    }

	
	//Agrega un nuevo hijo (verificado)
	public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"), true);
			
			$id_padre = $_POST['id_padre'] ?? null;
            $nombre = $_POST['nombre'] ?? null;
            $fechaNacimiento = $_POST['fechaNacimiento'] ?? null;
            $documento = $_POST['documento'] ?? null;

            if ($nombre && $fechaNacimiento && $id_padre) {
                $resultado = $this->hijoModel->insertarHijo($id_padre, $nombre, $fechaNacimiento, $documento);

                if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Hijo guardado correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al guardar hijo"]);
                }
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(["success" => false, "message" => "Datos incompletos"]);
            }
        }
    }
	
	
	// Borrar hijo (verificado)
	public function borrarHijo() {
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $json = file_get_contents('php://input');
			$datos = json_decode($json, true);
			$id_hijo = $datos["id_hijo"] ?? null;

            if ($id_hijo) {
                $resultado = $this->hijoModel->borrarHijo($id_hijo);
                 if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Hijo borrado correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al borrar hijo"]);
                } 
			} else {
				header('Content-Type: application/json', true, 400);
				echo json_encode(["success" => false, "message" => "Datos incompletos"]);
				
                //exit();
			}
        }
    }
	
	
	// Borrar hijos por padre (verificado)
	public function borrarHijosPorPadre() {
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $json = file_get_contents('php://input');
			$datos = json_decode($json, true);
			$id_padre = $datos["id_padre"] ?? null;

            if ($id_padre) {
                $resultado = $this->hijoModel->borrarHijosPorPadre($id_padre);
                 if ($resultado) {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => true, "message" => "Hijos borrados correctamente", "id" => $resultado]);
                } else {
                    header('Content-Type: application/json', true, 500);
                    echo json_encode(["success" => false, "message" => "Error al borrar hijos"]);
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
