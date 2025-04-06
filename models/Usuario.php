<?php

require_once("../config/database.php");

class Usuario {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function verificarCredenciales($nombre_usuario, $password) {
        $sql = "SELECT * FROM USUARIO 
		WHERE nombre_usuario = :nombre_usuario AND contrasena = :password LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre_usuario' => $nombre_usuario,
            ':password' => $password
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuarioLogueado($cod_usuario, $estado) {
        $sql = "UPDATE USUARIO SET usuario_logueado = :usuario_logueado WHERE ID_Usuario = :cod_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':usuario_logueado' => $estado,
            ':cod_usuario' => $cod_usuario
        ]);
    }
}
?>
