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
$page_title = "Agregar Empleado";
$page_description = "Agregar Nuevo Empleado";
$action_to_do = "routes.php?controller=Empleado&action=store";
$id = "0";
if (isset($empleado)) {
	$page_title = "Actualizar Empleado";
	$page_description = "Actualizar Datos de Empleado";
	$action_to_do = "routes.php?controller=Empleado&action=guardarModificacion";
	$id = $empleado['ID_Persona'];
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
    <!--<form method="POST" action="views/listar_personas.php?action=guardar_nuevo">-->
	<form action="<?php echo $action_to_do; ?>" method="POST">
	<p>Datos personales:</p>
		<?php 
			if(isset($empleado)) {
				echo "<label for='nombre'>Nombre:</label>";
				echo "<input type='text' name='nombre' id='nombre' value='". $empleado['Nombre'] ."' required>";
				echo "<br>";
				echo "<label for='apellido'>Apellido:</label>";
				echo "<input type='text' name='apellido' id='apellido' value='" . $empleado['Apellido'] . "' required>";
				echo "<br>";
				echo "<label for='direccion'>Documento:</label>";
				echo "<input type='text' name='documento' id='documento' value=" . $empleado['Documento']." required>";
				echo "<br>";
				echo "<label for='direccion'>Dirección:</label>";
				echo "<input type='text' name='direccion' id='direccion' value=" . $empleado['Direccion'] ." required>";
				echo "<br>";
				echo "<label for='direccion'>Teléfono:</label>";
				echo "<input type='text' name='telefono' id='telefono' value=". $empleado['Telefono'] ." required>";
				echo "<br>";
				echo "<label for='direccion'>Email:</label>";
				echo "<input type='text' name='email' id='email' value=" . $empleado['Email'] ." required>";
				echo "<br>";
				echo "<input type='hidden' name='id' id='id' value=". $empleado['ID_Persona'] .">";
			} else {
				echo "<label for='idPersona'>ID Persona:</label>";
				echo "<input type='text' name='idPersona' id='idPersona' required>";
				echo "<br>";
				/*
				echo "<label for='apellido'>Apellido:</label>";
				echo "<input type='text' name='apellido' id='apellido' required>";
				echo "<br>";
				echo "<label for='direccion'>Documento:</label>";
				echo "<input type='text' name='documento' id='documento' required>";
				echo "<br>";
				echo "<label for='direccion'>Dirección:</label>";
				echo "<input type='text' name='direccion' id='direccion' required>";
				echo "<br>";
				echo "<label for='direccion'>Teléfono:</label>";
				echo "<input type='text' name='telefono' id='telefono' required>";
				echo "<br>";
				echo "<label for='direccion'>Email:</label>";
				echo "<input type='text' name='email' id='email' required>";
				echo "<br>";
				*/
				echo "<label for='fechaIngreso'>Fecha Ingreso:</label>";
				echo "<input type='text' name='fechaIngreso' id='fechaIngreso' required>";
				echo "<br>";
				
				echo "<label for='salario'>Salario:</label>";
				echo "<input type='text' name='salario' id='salario' required>";
				echo "<br>";
				
				foreach ($cargos as $cargo): 
				
					echo "<label for='cargo'>Cargo:</label>";

					echo "<select name='cargo' id='cargo'>";
					echo "<option value='" . $cargo['ID_Cargo'] . "'>" . $cargo['Descripcion'] . "</option>";
						
					echo "</select>";
					echo "<br>";
				endforeach;
				
				foreach ($departamentos as $departamento): 
				
					echo "<label for='departamento'>Departamento:</label>";

					echo "<select name='departamento' id='departamento'>";
					echo "<option value='" . $departamento['ID_Departamento'] . "'>" . $departamento['Nombre_Departamento'] . "</option>";
						
					echo "</select>";
					echo "<br>";
				endforeach;
				
				
				
			}
		?>
        
		<!--<p>Datos Laborales:</p>-->
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
