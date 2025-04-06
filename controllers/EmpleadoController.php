<?php

require_once("models/empleado.php");
require_once("models/departamento.php");
require_once("models/cargo.php");

class EmpleadoController {
    private $empleadoModel;
	private $departamentModel;
	private $cargoModel;

    public function __construct() {
        $this->empleadoModel = new Empleado();
		$this->departamentModel = new Departamento();
		$this->cargoModel = new Cargo();
    }

    // Mostrar la lista de empleados
    public function index() {
        $empleados = $this->empleadoModel->listarEmpleados();
		$cargos = $this->cargoModel->listarCargos();
		$departamentos = $this->departamentModel->listarDepartamentos();
        require_once("views/listar_empleados.php");
    }

    // Mostrar el formulario para modificar un empleado
    public function modificar() {
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			$id = $_GET['id'] ?? "0";
			$empleado = $this->empleadoModel->obtenerEmpleado($id);
			require_once("views/v_empleado.php");
		}
        $empleado = $this->empleadoModel->obtenerEmpleado($id);
        require_once("views/modificar_empleado.php");
    }

    // Guardar cambios en un empleado
    public function guardarModificacion($id, $nombre, $apellido, $direccion) {
        $this->empleadoModel->actualizarEmpleado($id, $nombre, $apellido, $direccion);
        header("Location: /mvc/public/index.php?action=listar");
        exit();
    }

    // Mostrar el formulario para agregar un nuevo empleado
    public function agregar() {
		$cargos = $this->cargoModel->listarCargos();
		$departamentos = $this->departamentModel->listarDepartamentos();
		$agregar_empleado = true;
        require_once("views/v_empleado.php");
    }
	
	public function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idPersona = $_POST['idPersona'] ?? null;
			$fechaIngreso = $_POST['fechaIngreso'] ?? null;
			$cargo = $_POST['cargo'] ?? null;
			$departamento = $_POST['departamento'] ?? null;
            $fechaNacimiento = $_POST['fechaNacimiento'] ?? null;
            $id = $_POST['id'] ?? null;
            if ($nombre && $fechaNacimiento && $id) {
                $resultado = $this->hijoModel->insertarHijo($id, $nombre, $fechaNacimiento);
                if ($resultado) {
                    header("Location: routes.php?controller=Empleado&action=index&id=" . $id . "&status=success");
                } else {
                    header("Location: routes.php?controller=Empleado&action=index&id=" . $id . "&status=error");
                }
                exit();
            }
        }
        require_once 'views/v_persona.php';
    }

}
?>
