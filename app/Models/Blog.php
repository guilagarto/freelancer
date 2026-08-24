<?php
namespace App\Models;

use Core\Database;
use PDO;

class Blog {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Busca todos os posts do blog ordenados pelos mais recentes
    public function getAllPosts(): array {
        $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

        // Insere uma nova vaga ou notícia no banco de dados através do painel Admin
    public function createPost(string $title, string $content, string $type): bool {
        $sql = "INSERT INTO blog_posts (title, content, type) VALUES (:title, :content, :type)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':type' => $type
        ]);
    }
        // Deleta uma publicação do blog usando o ID
    public function deletePost(int $id): bool {
        $sql = "DELETE FROM blog_posts WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }


}
