<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Cargos</title>
</head>
<body>
    <h1>Lista de Cargos</h1>
    <a href="/mvc/public/index.php?action=agregar">Agregar nuevo cargo</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripci&oacute;n</th>
                <th>Salario Base</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaCargos as $cargo): ?>
                <tr>
                    <td><?php echo $cargo['Nombre_Cargo']; ?></td>
                    <td><?php echo $cargo['Descripcion']; ?></td>
                    <td><?php echo $cargo['Salario_Referencia']; ?></td>
                    <td>
                        <a href="modificar_cargo.php?action=modificar&id=<?php echo $cargo['ID_Cargo']; ?>">Modificar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
