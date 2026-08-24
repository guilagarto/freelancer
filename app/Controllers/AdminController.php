<?php
namespace App\Controllers;

use App\Models\Blog;
use Core\Database;

class AdminController {
    
    // Exibe a tela de Login do Administrador (GET)
    public function loginForm() {
        require_once __DIR__ . '/../Views/admin_login.php';
    }

    // Processa o acesso do Administrador (POST)
    public function loginSubmit() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (!$email || empty($password)) {
            header("Location: /freela-app/public/admin/login?erro=1");
            exit;
        }

        // Busca o administrador na tabela específica
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $admin = $stmt->fetch();

        // Se o admin existir (ou se você usar o superlogin de criação inicial)
        if ($admin && password_verify($password, $admin['password']) || ($email === 'admin@freela.com' && $password === 'admin123')) {
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Garante uma conta real gravada caso use o superlogin
            if (!$admin) {
                $hashed = password_hash('admin123', PASSWORD_BCRYPT);
                $db->query("INSERT INTO admins (name, email, password) VALUES ('Admin', 'admin@freela.com', '$hashed')");
            }

            // Define as sessões exclusivas do Administrador
            $_SESSION['admin_id'] = $admin['id'] ?? 1;
            $_SESSION['admin_name'] = $admin['name'] ?? 'Administrador';
            
            header("Location: /freela-app/public/admin/painel");
            exit;
        } else {
            header("Location: /freela-app/public/admin/login?erro=1");
            exit;
        }
    }

    // Exibe o painel administrativo com o formulário de cadastro (GET)
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // SEGURANÇA: Se não for um admin logado, expulsa para a tela de login
        if (!isset($_SESSION['admin_id'])) {
            header("Location: /freela-app/public/admin/login");
            exit;
        }

        // Carrega as notícias atuais para exibir no painel também
        $blogModel = new Blog();
        $posts = $blogModel->getAllPosts();

        require_once __DIR__ . '/../Views/admin_dashboard.php';
    }

    // Processa e salva a nova vaga ou notícia enviada (POST)
    public function savePost() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin_id'])) {
            header("Location: /freela-app/public/admin/login");
            exit;
        }

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        $type = $_POST['type'] ?? 'noticia';

        if (!$title || !$content) {
            die("Erro: Título e Conteúdo são obrigatórios.");
        }

        $blogModel = new Blog();
        $success = $blogModel->createPost($title, $content, $type);

        if ($success) {
            header("Location: /freela-app/public/admin/painel?sucesso=1");
            exit;
        } else {
            die("Erro ao tentar cadastrar o artigo.");
        }
    }

    // Desconecta o Administrador
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        header("Location: /freela-app/public/admin/login");
        exit;
    }
        // Processa a exclusão da publicação (GET ou POST)
    public function removePost() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // SEGURANÇA: Se não for um admin logado, impede a ação
        if (!isset($_SESSION['admin_id'])) {
            header("Location: /freela-app/public/admin/login");
            exit;
        }

        // Pega o ID da publicação enviado pela URL
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $blogModel = new Blog();
            $blogModel->deletePost($id);
            
            // Redireciona de volta para o painel com aviso de excluído
            header("Location: /freela-app/public/admin/painel?excluido=1");
            exit;
        } else {
            die("Erro: ID de publicação inválido.");
        }
    }

}

