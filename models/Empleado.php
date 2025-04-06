<?php

require_once("config/database.php");

class Empleado {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Listar todos los empleados
    public function listarEmpleados() {
        $sql = "SELECT * FROM v_lista_empleado";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un empleado por ID
    public function obtenerEmpleado($id) {
        $sql = "SELECT * FROM empleado WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insertar un nuevo empleado
    public function insertarEmpleado($nombre, $apellido, $direccion) {
        $sql = "INSERT INTO empleado (nombre, apellido, direccion) VALUES (:nombre, :apellido, :direccion)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':direccion' => $direccion
        ]);
    }

    // Actualizar un empleado existente
    public function actualizarEmpleado($id, $nombre, $apellido, $direccion) {
        $sql = "UPDATE empleado SET nombre = :nombre, apellido = :apellido, direccion = :direccion WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':direccion' => $direccion,
            ':id' => $id
        ]);
    }
}
?>
