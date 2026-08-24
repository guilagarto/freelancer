<?php
namespace App\Controllers;

use App\Models\Contract;

class ContractController {

    // Ação disparada quando o cliente clica em "Contratar"
    public function hire() {
        // Inicializa a sessão se ainda não foi iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 1. Segurança: Impede acessos de pessoas deslogadas ou que não são clientes
        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'client') {
            header("Location: /freela-app/public/login");
            exit;
        }

        // 2. Coleta os dados do formulário enviado via POST
        $professionalId = filter_input(INPUT_POST, 'professional_id', FILTER_VALIDATE_INT);
        $phone = $_POST['phone'] ?? '';

        // 3. Proteção: Se os dados vierem vazios (atualização de página por exemplo) joga para os pedidos
        if (!$professionalId || empty($phone)) {
            header("Location: /freela-app/public/meus-pedidos");
            exit;
        }

        // 4. Cria o contrato no banco de dados
        $model = new Contract();
        $model->create($_SESSION['user_id'], $professionalId);

        // 5. Redireciona para o WhatsApp do profissional autônomo de forma limpa
        header("Location: https://wa.me");
        exit;
    }

    // Exibe a página com o histórico de contratações do cliente
    public function myOrders() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'client') {
            header("Location: /freela-app/public/login");
            exit;
        }

        $model = new Contract();
        $orders = $model->getContractsByClient($_SESSION['user_id']);
        
        // Verifica se cada contrato da lista já foi avaliado
        foreach ($orders as &$order) {
            $order['already_reviewed'] = $model->isReviewed($order['id']);
        }

        require_once __DIR__ . '/../Views/client_orders.php';
    }

    // Altera o status do contrato para concluído
    public function complete() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'client') {
            header("Location: /freela-app/public/login");
            exit;
        }

        $contractId = filter_input(INPUT_POST, 'contract_id', FILTER_VALIDATE_INT);
        
        if ($contractId) {
            $model = new Contract();
            $model->finishContract($contractId, $_SESSION['user_id']);
        }

        header("Location: /freela-app/public/meus-pedidos");
        exit;
    }
}
