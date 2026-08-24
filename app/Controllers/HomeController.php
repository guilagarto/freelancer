<?php
namespace App\Controllers;

use App\Models\Blog;

class HomeController {
    
    // Página Inicial
    public function index() {
        require_once __DIR__ . '/../Views/home.php';
    }

    // Página Sobre + Formulário de Contato integrado
    public function sobre() {
        require_once __DIR__ . '/../Views/sobre.php';
    }

    // Ação que recebe o Formulário de Contato via POST
    public function sendContact() {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$name || !$email || !$message) {
            die("Erro: Todos os campos do contato são obrigatórios.");
        }

        // DICA PROFISSIONAL: Em produção, você usaria o PHPMailer para disparar o e-mail real aqui.
        // Como estamos em localhost, vamos apenas simular salvando o redirecionamento com sucesso:
        header("Location: /freela-app/public/sobre?contato=sucesso");
        exit;
    }

    // Lista as Notícias e Vagas do Blog puxando do banco de dados
    public function blog() {
        $model = new Blog();
        $posts = $model->getAllPosts();

        require_once __DIR__ . '/../Views/blog_list.php';
    }

    // Exibe a Política de Privacidade exigida pelo AdSense
    public function privacidade() {
        require_once __DIR__ . '/../Views/privacidade.php';
    }
}
