<?php
namespace App\Models;

use Core\Database;
use PDO;

class User {
    private PDO $db;

    public function __construct() {
        // Conecta automaticamente ao banco de dados usando o nosso Core
        $this->db = Database::connect();
    }

    // Verifica se um e-mail já está cadastrado no sistema
    public function emailExists(string $email): bool {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() ? true : false;
    }

    // Cria o usuário na tabela principal e retorna o ID gerado
    public function create(string $name, string $email, string $password, string $user_type): int|false {
        // Criptografa a senha usando a tecnologia mais segura do PHP (BCRYPT)
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (name, email, password, user_type) VALUES (:name, :email, :password, :user_type)";
        $stmt = $this->db->prepare($sql);
        
        $success = $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':user_type' => $user_type
        ]);

        // Se salvou com sucesso, retorna o ID do novo usuário
        return $success ? (int)$this->db->lastInsertId() : false;
    }
        // Busca um usuário pelo e-mail para realizar o login
    public function getByEmail(string $email): array|false {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
}


