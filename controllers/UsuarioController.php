<?php

require_once("../models/Usuario.php");

class UsuarioController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre_usuario = $_POST['nombre_usuario'];
            $password = $_POST['password'];

            $usuario = $this->usuarioModel->verificarCredenciales($nombre_usuario, $password);

            if ($usuario) {
                session_start();
                $_SESSION['ID_Usuario'] = $usuario['ID_Usuario'];
				//var_dump($_SESSION);
                $this->usuarioModel->actualizarUsuarioLogueado($usuario['ID_Usuario'], true);
                header("Location: ../views/dashboard.php");
                exit();
            } else {
                echo "Usuario o contraseña incorrectos.";
            }
        }
        require_once("../views/login.php");
    }

    public function logout() {
        session_start();
        if (isset($_SESSION['ID_Usuario'])) {
            $id_usuario = $_SESSION['ID_Usuario'];
            //$this->usuarioModel->actualizarUsuarioLogueado($id_usuario, false);
            session_unset();
            session_destroy();
        }
        header("Location: ../views/login.php");
        exit();
    }
}
?>
