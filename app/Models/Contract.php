<?php
namespace App\Models;

use Core\Database;
use PDO;

class Contract {
    private PDO $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Registra uma nova intenção de contratação
    public function create(int $clientId, int $professionalId): int|false {
        $sql = "INSERT INTO contracts (client_id, professional_id, status) VALUES (:client_id, :professional_id, 'em_andamento')";
        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute([
            ':client_id' => $clientId,
            ':professional_id' => $professionalId
        ]);
        return $success ? (int)$this->db->lastInsertId() : false;
    }

    // Busca todos os contratos de um cliente específico
    public function getContractsByClient(int $clientId): array {
        $sql = "SELECT c.*, u.name as professional_name, p.category 
                FROM contracts c
                JOIN users u ON c.professional_id = u.id
                JOIN professional_profiles p ON u.id = p.user_id
                WHERE c.client_id = :client_id
                ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':client_id' => $clientId]);
        return $stmt->fetchAll();
    }

    // Altera o status do serviço para concluído
    public function finishContract(int $contractId, int $clientId): bool {
        $sql = "UPDATE contracts SET status = 'concluido' WHERE id = :id AND client_id = :client_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $contractId,
            ':client_id' => $clientId
        ]);
    }

    // Verifica se o contrato já foi avaliado para não avaliar duas vezes
    public function isReviewed(int $contractId): bool {
        $sql = "SELECT id FROM reviews WHERE contract_id = :contract_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':contract_id' => $contractId]);
        return $stmt->fetch() ? true : false;
    }
}
