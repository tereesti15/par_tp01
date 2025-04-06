<?php

//require_once("../config/database.php");
//require_once("../models/Persona.php");
//require_once(realpath(dirname(__FILE__))."/controllers/PersonaController.php");

//$personaModel = new Persona($pdo);
//$personaController = new PersonaController();

//$personaController->listar();
//$personas=$personaModel->listarPersona();

//$personaController = new PersonaController();
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

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Personas</title>
</head>
<body>
    <h1>Lista de Personas</h1>
    <a href="routes.php?controller=Persona&action=agregar">Agregar nueva persona</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Documento</th>
				<th>Dirección</th>
				<th>Telefono</th>
				<th>Email</th>
				<th>Hijos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personas as $persona): ?>
                <tr>
                    <td><?php echo $persona['Nombre']; ?></td>
                    <td><?php echo $persona['Apellido']; ?></td>
                    <td><?php echo $persona['Documento']; ?></td>
					<td><?php echo $persona['Direccion']; ?></td>
					<td><?php echo $persona['Telefono']; ?></td>
					<td><?php echo $persona['Email']; ?></td>
					<td><?php 
							if ($persona['cant_hijo'] == "0") {
								echo "<a href='routes.php?controller=Hijo&action=index&id=" . $persona['ID_Persona'] . "'>Sin hijos</a>";
							} else {
								echo "<a href='routes.php?controller=Hijo&action=index&id=" . $persona['ID_Persona'] . "'>Tiene " . $persona['cant_hijo'] . "</a>";
							}
						?>
					</td>
                    <td>
                        <a href="routes.php?controller=Persona&action=modificar&id=<?php echo $persona['ID_Persona']; ?>">Modificar</a>
						&nbsp;
						<a href="routes.php?controller=Persona&action=borrar&id=<?php echo $persona['ID_Persona']; ?>">Borrar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>	
</body>
</html>
