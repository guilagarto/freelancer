<?php
namespace App\Models;

use Core\Database;
use PDO;

class Professional {
    private PDO $db;

    public function __construct() {
        // Conecta ao banco usando nossa classe core
        $this->db = Database::connect();
    }

    // Cria o perfil em branco para o profissional preencher depois
    public function createProfile(int $userId): bool {
        $sql = "INSERT INTO professional_profiles (user_id, category) VALUES (:user_id, :category)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':user_id' => $userId,
            ':category' => 'Não definida'
        ]);
    }

    // Busca todos os profissionais cadastrados na plataforma
        // Atualizado: Busca os profissionais incluindo o campo da foto (avatar)
        // Busca os profissionais, aceitando um filtro opcional de categoria
    public function getAllProfessionals(?string $category = null): array {
        if ($category) {
            // Se o usuário filtrou por categoria, busca apenas os profissionais dela
            $sql = "SELECT u.name, u.email, p.category, p.bio, p.price_per_hour, p.phone, p.avatar 
                    FROM professional_profiles p
                    JOIN users u ON p.user_id = u.id
                    WHERE p.category = :category";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':category' => $category]);
        } else {
            // Se não houver filtro, traz todo mundo ordenado por categoria para facilitar o agrupamento
            $sql = "SELECT u.name, u.email, p.category, p.bio, p.price_per_hour, p.phone, p.avatar 
                    FROM professional_profiles p
                    JOIN users u ON p.user_id = u.id
                    ORDER BY p.category ASC";
            $stmt = $this->db->query($sql);
        }
        
        return $stmt->fetchAll();
    }

    // Busca apenas os nomes de todas as categorias cadastradas no banco (Para gerar os botões de filtro automaticamente)
    public function getDistinctCategories(): array {
        $sql = "SELECT DISTINCT category FROM professional_profiles WHERE category != 'Não definida' ORDER BY category ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    // Busca os dados do perfil do profissional pelo ID do usuário logado
    public function getProfileByUserId(int $userId): array|false {
        $sql = "SELECT p.*, u.name FROM professional_profiles p 
                JOIN users u ON p.user_id = u.id 
                WHERE p.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetch();
    }

    // Salva as alterações feitas pelo profissional no painel
    public function updateProfile(int $userId, string $category, string $bio, float $price, string $phone): bool {
        $sql = "UPDATE professional_profiles 
                SET category = :category, bio = :bio, price_per_hour = :price, phone = :phone 
                WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':category' => $category,
            ':bio' => $bio,
            ':price' => $price,
            ':phone' => $phone,
            ':user_id' => $userId
        ]);
    }

    // Busca todas as avaliações de um profissional específico
    public function getReviews(int $professionalId): array {
        $sql = "SELECT * FROM reviews WHERE professional_id = :id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $professionalId]);
        return $stmt->fetchAll();
    }

    // Calcula a média de estrelas e o total de avaliações de um profissional
    public function getRatingInfo(int $professionalId): array {
        $sql = "SELECT AVG(rating) as average, COUNT(id) as total FROM reviews WHERE professional_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $professionalId]);
        $result = $stmt->fetch();
        
        return [
            'average' => $result['average'] ? round($result['average'], 1) : 0,
            'total' => $result['total']
        ];
    }

    // Salva uma nova avaliação no banco de dados
    public function saveReview(int $professionalId, string $clientName, int $rating, string $comment, int $contractId): bool {
        $sql = "INSERT INTO reviews (professional_id, client_name, rating, comment, contract_id) 
                VALUES (:professional_id, :client_name, :rating, :comment, :contract_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':professional_id' => $professionalId,
            ':client_name' => $clientName,
            ':rating' => $rating,
            ':comment' => $comment,
            ':contract_id' => $contractId
        ]);
    }

    // Busca os comentários de texto deixados pelos clientes para este profissional
    public function getCommentsByProfessional(int $professionalId): array {
        $sql = "SELECT client_name, rating, comment, created_at 
                FROM reviews 
                WHERE professional_id = :id 
                ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $professionalId]);
        return $stmt->fetchAll();
    }
    // Salva as alterações do painel incluindo a foto de perfil
    public function updateProfileWithAvatar(int $userId, string $category, string $bio, float $price, string $phone, ?string $avatarName): bool {
        if ($avatarName) {
            // Se enviou uma foto nova, atualiza todos os campos e o avatar
            $sql = "UPDATE professional_profiles 
                    SET category = :category, bio = :bio, price_per_hour = :price, phone = :phone, avatar = :avatar 
                    WHERE user_id = :user_id";
            $params = [
                ':category' => $category, ':bio' => $bio, ':price' => $price, 
                ':phone' => $phone, ':avatar' => $avatarName, ':user_id' => $userId
            ];
        } else {
            // Se não enviou foto, mantém a foto antiga rodando a query sem mexer no avatar
            $sql = "UPDATE professional_profiles 
                    SET category = :category, bio = :bio, price_per_hour = :price, phone = :phone 
                    WHERE user_id = :user_id";
            $params = [
                ':category' => $category, ':bio' => $bio, ':price' => $price, 
                ':phone' => $phone, ':user_id' => $userId
            ];
        }
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }


}
