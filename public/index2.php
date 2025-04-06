<?php
require_once("../config/database.php");
require_once("../models/Empleado.php");
require_once("../controllers/EmpleadoController.php");

$empleadoModel = new Empleado($pdo);
$empleadoController = new EmpleadoController($empleadoModel);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'listar':
        $empleadoController->listar();
        break;
    case 'modificar':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $empleadoController->modificar($id);
        break;
    case 'guardar_modificacion':
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $empleadoController->guardarModificacion($id, $nombre, $apellido, $direccion);
        break;
    case 'agregar':
        $empleadoController->agregar();
        break;
    case 'guardar_nuevo':
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $empleadoController->guardarNuevo($nombre, $apellido, $direccion);
        break;
    default:
        $empleadoController->listar();
        break;
}
?>
