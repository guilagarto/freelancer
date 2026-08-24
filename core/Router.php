<?php
namespace Core;

class Router {
    // Guarda todas as rotas registradas (GET e POST)
    private array $routes = [];

    // Registra uma rota do tipo GET
    public function get(string $path, array $handler): void {
        $this->routes['GET'][$path] = $handler;
    }

    // Registra uma rota do tipo POST (para formulários)
    public function post(string $path, array $handler): void {
        $this->routes['POST'][$path] = $handler;
    }

    // Processa a URL atual de forma inteligente e descobre o que fazer
    public function resolve(): void {
        $method = $_SERVER['REQUEST_METHOD'];

        // 1. Captura a URL vinda do .htaccess do XAMPP
        if (isset($_GET['url'])) {
            $url = '/' . rtrim($_GET['url'], '/');
        } else {
            $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            // Remove a pasta do projeto da rota para o roteador não se confundir
            $url = str_replace('/freela-app/public', '', $requestUri);
            $url = $url === '' ? '/' : '/' . rtrim(ltrim($url, '/'), '/');
        }

        // 2. CORREÇÃO CRÍTICA: Limpa os parâmetros de busca (como ?url= ou ?erro=) pegando apenas a rota limpa
        $urlParts = explode('?', $url);
        $cleanUrl = $urlParts[0]; // <-- Pega apenas o primeiro pedaço (o texto da rota)

        // Garante que a raiz vazia sempre vire '/'
        if (empty($cleanUrl)) {
            $cleanUrl = '/';
        }

        // 3. Verifica se a rota existe para o método atual (GET ou POST)
        if (isset($this->routes[$method][$cleanUrl])) {
            $handler = $this->routes[$method][$cleanUrl];
            $controllerClass = $handler[0];
            $action = $handler[1];

            // Instancia o controlador de forma automática
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                
                // Executa a função do controlador
                if (method_exists($controller, $action)) {
                    $controller->$action();
                    return;
                }
            }
        }

        // Se a rota não existir, exibe erro 404 detalhado
        http_response_code(404);
        echo "<h1>🚫 Página não encontrada (Erro 404)</h1>";
        echo "<p>O roteador não encontrou o caminho: <strong>[$method] $cleanUrl</strong></p>";
    }
}
