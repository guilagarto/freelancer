<?php
namespace App\Controllers;

use App\Models\Professional;

class ProfessionalController {
    
    // Lista os profissionais com suas notas médias e histórico de comentários
        // Lista os profissionais separados e filtrados por categoria
    public function list() {
        $model = new Professional();
        
        // Captura o filtro de categoria via GET se ele existir na URL
        $selectedCategory = filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Busca a lista de categorias únicas para desenhar a barra de navegação/botões
        $categoriesList = $model->getDistinctCategories();

        // Busca os profissionais (filtrados ou todos)
        $rawProfessionals = $model->getAllProfessionals($selectedCategory);
        $groupedProfessionals = [];

        foreach ($rawProfessionals as $prof) {
            $sql = "SELECT user_id FROM professional_profiles WHERE phone = :phone";
            $db = \Core\Database::connect();
            $stmt = $db->prepare($sql);
            $stmt->execute([':phone' => $prof['phone']]);
            $userId = $stmt->fetchColumn();

            $ratingInfo = $model->getRatingInfo($userId);
            $comments = $model->getCommentsByProfessional($userId);

            $prof['id'] = $userId; 
            $prof['rating_average'] = $ratingInfo['average'];
            $prof['rating_total'] = $ratingInfo['total'];
            $prof['comments'] = $comments; 
            
            // MÁGICA: Agrupa os profissionais usando o nome da categoria como chave do array
            $categoryName = $prof['category'];
            $groupedProfessionals[$categoryName][] = $prof;
        }

        require_once __DIR__ . '/../Views/professionals_list.php';
    

    }

    // Processa o envio do formulário de avaliação (POST)
    public function addReview() {
        $professionalId = filter_input(INPUT_POST, 'professional_id', FILTER_VALIDATE_INT);
        $contractId = filter_input(INPUT_POST, 'contract_id', FILTER_VALIDATE_INT);
        $clientName = filter_input(INPUT_POST, 'client_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$professionalId || !$clientName || !$rating || !$comment || !$contractId) {
            die("Erro: Todos os campos da avaliação são obrigatórios.");
        }

        $model = new Professional();
        $success = $model->saveReview($professionalId, $clientName, $rating, $comment, $contractId);

        if ($success) {
            header("Location: /freela-app/public/meus-pedidos?avaliado=1");
            exit;
        } else {
            die("Erro ao salvar avaliação.");
        }
    }

    // Exibe o painel de controle (GET)
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Segurança: Impede acessos de pessoas deslogadas ou tipos incorretos
        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'professional') {
            header("Location: /freela-app/public/login");
            exit;
        }

        $model = new Professional();
        $profile = $model->getProfileByUserId($_SESSION['user_id']);

        require_once __DIR__ . '/../Views/dashboard.php';
    }

    // Salva as informações do painel incluindo a foto de perfil enviada (POST)
    public function dashboardSave() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'professional') {
            header("Location: /freela-app/public/login");
            exit;
        }

        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
        $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, 'price_per_hour', FILTER_VALIDATE_FLOAT);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);

        $avatarName = null;

        // Trata o Upload de Arquivo enviado via formulário
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['avatar']['tmp_name'];
            $fileName = $_FILES['avatar']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Extensões permitidas por segurança
            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            if (in_array($fileExtension, $allowedExtensions)) {
                // Cria a pasta uploads dentro da pasta public se não existir
                $uploadFileDir = __DIR__ . '/../../public/uploads/';
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }

                // Gera um nome único criptografado para o arquivo para evitar sobrescritas
                $avatarName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $avatarName;

                // Move o arquivo temporário do Linux para a pasta pública
                if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                    $avatarName = null; 
                }
            }
        }

        $model = new Professional();
        // Dispara a query de gravação usando o método do avatar opcional
        $success = $model->updateProfileWithAvatar($_SESSION['user_id'], $category, $bio, $price, $phone, $avatarName);

        if ($success) {
            header("Location: /freela-app/public/painel?salvo=1");
            exit;
        } else {
            die("Erro ao salvar as informações do painel.");
        }
    }
}
