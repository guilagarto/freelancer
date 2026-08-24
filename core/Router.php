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
        // Processa a URL atual na hospedagem e descobre o que fazer
    public function resolve(): void {
        $method = $_SERVER['REQUEST_METHOD'];

        // 1. Captura a URL vinda do .htaccess
        if (isset($_GET['url'])) {
            $url = '/' . rtrim($_GET['url'], '/');
        } else {
            $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            // Remove as pastas do caminho para não confundir o roteador na nuvem
            $url = str_replace('/freela-app/public', '', $requestUri);
            $url = str_replace('/public', '', $url); // <-- NOVO: Remove o /public se o servidor injetar ele na URI
            $url = $url === '' ? '/' : '/' . rtrim(ltrim($url, '/'), '/');
        }

        // 2. Limpa os parâmetros de busca pegando apenas a rota limpa
        $urlParts = explode('?', $url);
        $cleanUrl = $urlParts[0]; 

        // Se a rota limpada vier como '/public' ou vazia, joga para a raiz '/'
        if ($cleanUrl === '' || $cleanUrl === '/public') {
            $cleanUrl = '/';
        }

        // 3. Verifica se a rota existe para o método atual (GET ou POST)
        if (isset($this->routes[$method][$cleanUrl])) {
            $handler = $this->routes[$method][$cleanUrl];
            $controllerClass = $handler[0];
            $action = $handler[1];

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                if (method_exists($controller, $action)) {
                    $controller->$action();
                    return;
                }
            }
        }

        // Se mesmo limpando tudo a rota não bater, exibe o erro 404 de ajuda
        http_response_code(404);
        echo "<h1>🚫 Página não encontrada (Erro 404)</h1>";
        echo "<p>O roteador não encontrou o caminho: <strong>[$method] $cleanUrl</strong></p>";
    }

}
