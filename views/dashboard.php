<?php
session_start();
if (!isset($_SESSION['ID_Usuario'])) {
    header("Location: /login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido al dashboard <?php 
		if (isset($usuario)) {
			echo $usuario['Nombre_Usuario'];
		}
	//echo $_SESSION['Nombre_Usuario']; 
	?></h1>
    <p>Has iniciado sesión exitosamente.</p>
	
	<!--<p><a href="listar_personas.php">Men&uacute; Persona</a></p> -->
	
	
	<li><a href="../routes.php?controller=Persona&action=index">Gestionar Personas</a></li>
    <li><a href="../routes.php?controller=Empleado&action=index">Gestionar Empleados</a></li>
    <li><a href="../routes.php?controller=Cargo&action=index">Gestionar Cargos</a></li>
	
	
    <li><a href="../public/index.php?logout=true">Cerrar sesión</a></li>
</body>
</html>
