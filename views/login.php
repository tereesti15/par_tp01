<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <form method="POST" action="">
        <label for="nombre_usuario">Nombre de usuario:</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Iniciar sesión</button>
    </form>
	<p>No tienes una cuenta? <a href="../views/agregar_empleado.php">Puedes crear una cuenta nueva aqu&iacute;</a>
</body>
</html>
