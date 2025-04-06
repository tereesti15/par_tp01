<?php


//require_once("../config/database.php");
//require_once("../models/Persona.php");
//require_once("../controllers/PersonaController.php");

//$personaModel = new Persona($pdo);
//$personaController = new PersonaController($personaModel);

/*
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
    case 'modificar':
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $documento = $_POST['documento'];
		$direccion = $_POST['direccion'];
		$telefono = $_POST['telefono'];
		$email = $_POST['email'];
        //$empleadoController->guardarNuevo($nombre, $apellido, $documento ,$direccion, $telefono, $email);
        $personaModel->insertarPersona($nombre, $apellido, $documento, $direccion, $telefono, $email);
		$personas=$personaModel->listarPersona();
		break;
    default:
        $personas=$personaModel->listarPersona();
        break;
}
*/
$page_title = "";
$page_description = "";
$action_to_do = "";
$id = $persona['ID_Persona'];
if (isset($agregarHijo)) {
	$page_title = "Agregar Hijo";
	$page_description = "Agregar Nuevo Hijo a " . $persona['Apellido'] . ", " . $persona['Nombre'];
	$action_to_do = "routes.php?controller=Hijo&action=store";

} else {
	$page_title = "Actualizar Hijo";
	$page_description = "Actualizar Datos de Hijo de " . $persona['Apellido'] . ", " . $persona['Nombre'];
	$action_to_do = "routes.php?controller=Hijo&action=guardarModificacion";
	$id = $hijo['ID_Hijo'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
</head>
<body>
    <h1><?php echo $page_description; ?></h1>
	<form action="<?php echo $action_to_do; ?>" method="POST">
	<p>Datos personales:</p>
		<?php 
			if(isset($hijo)) {
				echo "<label for='nombre'>Nombre:</label>";
				echo "<input type='text' name='nombre' id='nombre' value='". $hijo['Nombre'] ."' required>";
				echo "<br>";
				echo "<label for='fechaNacimiento'>Fecha Nacimiento:</label>";
				echo "<input type='text' name='fechaNacimiento' id='fechaNacimiento' value='" . $hijo['Fecha_Nacimiento'] . "' required>";
				echo "<br>";
				echo "<input type='hidden' name='id' id='id' value=". $hijo['ID_Hijo'] .">";
			} else {
				echo "<label for='nombre'>Nombre:</label>";
				echo "<input type='text' name='nombre' id='nombre' required>";
				echo "<br>";
				echo "<label for='fechaNacimiento'>Fecha Nacimiento:</label>";
				echo "<input type='text' name='fechaNacimiento' id='fechaNacimiento' required>";
				echo "<br>";
				echo "<input type='hidden' name='id' id='id' value=" . $id . ">";
			}
		?>
        
		<!--<p>Datos Laborales:</p>-->
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
