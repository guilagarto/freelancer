<?php
// 1. Exibição de erros (Muito importante para desenvolvimento no XAMPP)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Inicializa as Sessões do PHP em todo o site
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3. Carrega o Autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

// 4. Carrega as variáveis do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// 5. Importa TODAS as classes que o projeto utiliza
use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ProfessionalController;
use App\Controllers\ContractController; 
use App\Controllers\AdminController; // <-- GARANTE A IMPORTAÇÃO DO CONTROLADOR DO ADMIN

// 6. Inicializa o roteador do sistema
$router = new Router();
// =========================================================================
// MÁGICA DO MVC: CADASTRO DE TODAS AS ROTAS DO SITE
// =========================================================================

// Rotas da Home e Páginas Estáticas
$router->get('/', [HomeController::class, 'index']);
$router->get('/sobre', [HomeController::class, 'sobre']);
$router->get('/privacidade', [HomeController::class, 'privacidade']);

// Rotas de Cadastro e Autenticação de Usuários Comuns (Login/Sair)
$router->get('/cadastrar', [AuthController::class, 'registerForm']);
$router->post('/cadastrar/salvar', [AuthController::class, 'registerSave']);
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login/entrar', [AuthController::class, 'loginLogin']);
$router->get('/sair', [AuthController::class, 'logout']);

// Rotas do Painel de Controle do Profissional Liberal
$router->get('/painel', [ProfessionalController::class, 'dashboard']);
$router->post('/painel/salvar', [ProfessionalController::class, 'dashboardSave']);

// Rota da Página Pública de Busca de Profissionais e Avaliação
$router->get('/profissionais', [ProfessionalController::class, 'list']);
$router->post('/avaliar/salvar', [ProfessionalController::class, 'addReview']);

// Rotas do Fluxo de Contratação Segura e Pedidos (Abordagem 2)
$router->post('/contratar/disparar', [ContractController::class, 'hire']);
$router->get('/meus-pedidos', [ContractController::class, 'myOrders']);
$router->post('/contrato/concluir', [ContractController::class, 'complete']);

// =========================================================================
// NOVO: AS ROTAS DO PAINEL DO ADMINISTRADOR QUE ESTAVAM FALTANDO
// =========================================================================
$router->get('/admin/login', [AdminController::class, 'loginForm']);          // Abre tela de login do admin
$router->post('/admin/login/entrar', [AdminController::class, 'loginSubmit']); // Processa acesso do admin
$router->get('/admin/painel', [AdminController::class, 'dashboard']);         // Abre o painel de postagens
$router->post('/admin/postar', [AdminController::class, 'savePost']);          // Salva os dados enviados
$router->get('/admin/postar/deletar', [AdminController::class, 'removePost']); // <-- ADICIONE ESSA LINHA AQUI!
$router->get('/admin/sair', [AdminController::class, 'logout']);              // Desconecta o admin
// =========================================================================

// Rota do Blog / Feed de Notícias Público
$router->get('/noticias', [HomeController::class, 'blog']);
$router->post('/contato/enviar', [HomeController::class, 'sendContact']);

// 7. Executa o roteador para processar a URL atual e carregar a página correspondente
$router->resolve();
