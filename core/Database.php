<?php
namespace Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function connect(): PDO {
        if (self::$instance === null) {
            try {
                // Puxa as configurações configuradas no seu arquivo .env
                $host = $_ENV['DB_HOST'];
                $dbname = $_ENV['DB_NAME'];
                $user = $_ENV['DB_USER'];
                $pass = $_ENV['DB_PASS'];

                // Conecta usando PDO (Padrão moderno do PHP)
                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4", 
                    $user, 
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erro crítico na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
