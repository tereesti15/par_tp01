<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Empleado</title>
</head>
<body>
    <h1>Agregar Nuevo Empleado</h1>
    <form method="POST" action="/public/dashboard.php?action=guardar_nuevo">
	<p>Datos personales:</p>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" required>
        <br>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" required>
        <br>
		<p>Datos Laborales:</p>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
