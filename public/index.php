<?php
//require_once("../config/database.php");
//require_once("../models/Usuario.php");

require_once("../controllers/UsuarioController.php");

$usuarioController = new UsuarioController();


if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    $usuarioController->logout();
} else {
    $usuarioController->login();
}
?>
