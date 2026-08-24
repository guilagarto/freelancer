<?php
namespace Core;

class Router {
    private array $routes = [];

    public function get(string $path, array $handler): void {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void {
        $this->routes['POST'][$path] = $handler;
    }

    public function resolve(): void {
        $method = $_SERVER['REQUEST_METHOD'];

        // 1. Captura o caminho enviado pelo servidor
        if (isset($_GET['url'])) {
            $url = '/' . rtrim($_GET['url'], '/');
        } else {
            $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $url = $requestUri;
        }

        // 2. LIMPEZA TOTAL DA URL (Remove pastas locais e a palavra public se o servidor injetar)
        $url = str_replace('/freela-app/public', '', $url);
        $url = str_replace('/freela-app', '', $url);
        $url = str_replace('/public', '', $url);
        
        // Garante a formatação correta com a barra no início e sem barra no fim
        $url = '/' . rtrim(ltrim($url, '/'), '/');

        // Divide a URL para arrancar parâmetros de busca fora (Ex: ?id=1 ou ?erro=1)
        $urlParts = explode('?', $url);
        $cleanUrl = $urlParts[0]; 

        // Se a rota vier limpa como barra dupla ou vazia, vira a raiz '/'
        if ($cleanUrl === '//' || $cleanUrl === '') {
            $cleanUrl = '/';
        }

        // 3. Executa a rota se ela existir na lista
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
