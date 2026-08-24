<?php
namespace App\Controllers;

// Importa os modelos que acabamos de criar
use App\Models\User;
use App\Models\Professional;

class AuthController {
    
    public function registerForm() {
        require_once __DIR__ . '/../Views/register.php';
    }

    public function registerSave() {
        // 1. Coleta e limpa os dados enviados pelo formulário
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';
        $user_type = $_POST['user_type'] ?? '';

        // Validação básica simples
        if (!$name || !$email || empty($password) || empty($user_type)) {
            die("Erro: Todos os campos são obrigatórios ou inválidos.");
        }

        // 2. Instancia o modelo de Usuário
        $userModel = new User();

        // Verifica se o email já existe
        if ($userModel->emailExists($email)) {
            die("Erro: Este e-mail já está cadastrado no sistema.");
        }

        // 3. Tenta salvar o usuário no banco de dados
        $userId = $userModel->create($name, $email, $password, $user_type);

        if ($userId) {
            // Se o usuário for um prestador de serviço (Pedreiro), cria o perfil profissional dele
            if ($user_type === 'professional') {
                $profileModel = new Professional();
                $profileModel->createProfile($userId);
            }

            // Cadastro concluído com sucesso! Redireciona para a home
            // (Futuramente redirecionaremos para o painel de login)
            header("Location: /freela-app/public/?cadastro=sucesso");
            exit;
        } else {
            die("Erro crítico ao tentar realizar o cadastro.");
        }
    }
        // Mostra a tela de login (GET)
    public function loginForm() {
        require_once __DIR__ . '/../Views/login.php';
    }

    // Processa o acesso do usuário (POST)
    public function loginLogin() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (!$email || empty($password)) {
            header("Location: /freela-app/public/login?erro=1");
            exit;
        }

        $userModel = new User();
        $user = $userModel->getByEmail($email);

        // Se o usuário existir e a senha criptografada bater
        if ($user && password_verify($password, $user['password'])) {
            
            // Inicia a sessão segura do PHP se ainda não estiver aberta
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Guarda os dados do usuário logado na memória do servidor
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_type'] = $user['user_type'];

            // Redireciona de acordo com o tipo de usuário
            // Por enquanto, jogaremos para a Home, mas com aviso de logado
            header("Location: /freela-app/public/?login=sucesso");
            exit;
        } else {
            // Se errar, volta para a tela de login com o aviso de erro
            header("Location: /freela-app/public/login?erro=1");
            exit;
        }
    }

    // Desconecta o usuário (Sair)
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: /freela-app/public/");
        exit;
    }

}

