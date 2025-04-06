<?php

//require_once("../config/database.php");
//require_once("../models/Persona.php");
//require_once(realpath(dirname(__FILE__))."/controllers/PersonaController.php");

//$personaModel = new Persona($pdo);
//$personaController = new PersonaController();

//$personaController->listar();
//$personas=$personaModel->listarPersona();

//$personaController = new PersonaController();
//$action = isset($_GET['action']) ? $_GET['action'] : '';
/*
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
        $documento = $_POST['documento'];
		$direccion = $_POST['direccion'];
		$telefono = $_POST['telefono'];
		$email = $_POST['email'];
        //$empleadoController->guardarNuevo($nombre, $apellido, $documento ,$direccion, $telefono, $email);
        //$personaModel->insertarPersona($nombre, $apellido, $documento, $direccion, $telefono, $email);
		//$personas=$personaModel->listarPersona();
		$personaController->guardarNuevo($nombre, $apellido, $documento ,$direccion, $telefono, $email);
		$personaController->index();
		break;
    default:
        //$personas=$personaModel->listarPersona();
		//$personaController->index();
        break;
}
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de hijos</title>
</head>
<body>
    <h1>Lista de Hijos de <?php echo $persona['Apellido'] . ", " . $persona['Nombre'] ?></h1>
    <a href="routes.php?controller=Hijo&action=agregarNuevoHijo&id=<?php echo $persona['ID_Persona']; ?>">Agregar nuevo hijo</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha Nacimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hijos as $hijo): ?>
                <tr>
                    <td><?php echo $hijo['Nombre']; ?></td>
                    <td><?php echo $hijo['Fecha_Nacimiento']; ?></td>
                    <td>
                        <a href="routes.php?controller=Hijo&action=modificarHijo&id=<?php echo $hijo['ID_Hijo']; ?>">Modificar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>	
</body>
</html>
