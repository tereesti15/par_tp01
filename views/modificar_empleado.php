<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Empleado</title>
</head>
<body>
    <h1>Modificar Empleado</h1>
    <form method="POST" action="/mvc/public/index.php?action=guardar_modificacion&id=<?php echo $empleado['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $empleado['nombre']; ?>" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" value="<?php echo $empleado['apellido']; ?>" required>
        <br>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" value="<?php echo $empleado['direccion']; ?>" required>
        <br>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
