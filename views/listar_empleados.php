<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Empleados</title>
</head>
<body>
    <h1>Lista de Empleados</h1>
    <a href="routes.php?controller=Empleado&action=agregar">Agregar nuevo empleado</a>
    <table border="1">
        <thead>
            <tr>
				<th>Legajo</th>
				<th>Documento</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado): ?>
                <tr>
					<td><?php echo $empleado['ID_Empleado']; ?></td>
					<td><?php echo $empleado['Documento']; ?></td>
                    <td><?php echo $empleado['Nombre']; ?></td>
                    <td><?php echo $empleado['Apellido']; ?></td>
                    <td>
                        <a href="routes.php?controller=Empleado&action=modificar&id=<?php echo $empleado['ID_Persona']; ?>">Modificar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
