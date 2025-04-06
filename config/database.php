<?php

class Database {
    private static $host = "localhost";   
    private static $user = "root";     
    private static $pass = "koki";  
    private static $dbname = "pago_nomina"; 
    private static $pdo = null;

    public static function connect() {
        if (self::$pdo === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8";
                self::$pdo = new PDO($dsn, self::$user, self::$pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Error de conexión a MariaDB: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function disconnect() {
        self::$pdo = null;
    }
}

?>
