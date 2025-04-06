<!DOCTYPE html>
<?php
require_once("../config/database.php");
require_once("../models/Empleado.php");
require_once("../controllers/EmpleadoController.php");


$action = isset($_GET['action']) ? $_GET['action'] : '';
$page_title = "";

switch ($action) {
    case 'listar':
        $empleadoController->listar();
		$page_title = "Listar Cargos";
        break;
    case 'modificar':
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $empleadoController->modificar($id);
		$page_title = "Modificar Cargos";
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

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title ?></title>
</head>
<body>




    <h1>Modificar cargo</h1>
    <form method="POST" action="/mvc/public/index.php?action=guardar_modificacion&id=<?php echo $listaCargo['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $listaCargo['Nombre_Cargo']; ?>" required>
        <br>
        <label for="apellido">Descripci&oacute;n:</label>
        <input type="text" name="descripcion" id="descripcion" value="<?php echo $listaCargo['Descripcion']; ?>" required>
        <br>
        <label for="direccion">Salario Base:</label>
        <input type="text" name="salario_referencia" id="salario_referencia" value="<?php echo $listaCargo['salario_referencia']; ?>" required>
        <br>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
