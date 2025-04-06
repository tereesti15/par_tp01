<?php
/*session_start();
if (!isset($_SESSION['ID_Usuario'])) {
    header("Location: /dashboard/trabajo/public/index.php");
    exit();
}*/
//echo realpath(dirname(__FILE__));
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'dashboard';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

/*
$controllerName = ucfirst($controller) . "Controller";
$redireccionA = "controllers/{$controllerName}.php";
//echo $redireccionA;
require_once $redireccionA;

//$controllerName = ucfirst($controller) . "Controller";
//require_once "app/controllers/{$controllerName}.php";

$controllerInstance = new $controllerName();
$controllerInstance->$action();
*/

$controllerName = ucfirst($controller) . "Controller";
require_once "controllers/{$controllerName}.php";
$controllerInstance = new $controllerName();

if (method_exists($controllerInstance, $action)) {
    $controllerInstance->$action();
} else {
    echo "Error: Acción no encontrada.";
}


?>
