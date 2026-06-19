<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');

require "../vendor/autoload.php";
require __DIR__ . '/../src/utils/helpers.php';

define('BASE_URL', '/php/public');

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    // entrada pública — abre a home sem exigir login
    $r->get('/',     'HomeController@index');
    $r->get('/home', 'HomeController@index');

    // clientes
    $r->get('/clientes',                   'ClienteController@listar');
    $r->get('/clientes/novo',              'ClienteController@novo');
    $r->post('/clientes/cadastrar',        'ClienteController@cadastrar');
    $r->get('/clientes/{id:\d+}',          'ClienteController@buscar');
    $r->get('/clientes/{id:\d+}/editar',   'ClienteController@editar');
    $r->post('/clientes/{id:\d+}/remover', 'ClienteController@remover');

    // destinos
    $r->get('/destinos',                   'DestinoController@listar');
    $r->get('/destinos/novo',              'DestinoController@novo');
    $r->post('/destinos/cadastrar',        'DestinoController@cadastrar');
    $r->get('/destinos/{id:\d+}',          'DestinoController@buscar');
    $r->get('/destinos/{id:\d+}/editar',   'DestinoController@editar');
    $r->post('/destinos/{id:\d+}/remover', 'DestinoController@remover');

    // pacotes
    $r->get('/pacotes',                   'PacoteDeTurismoController@listar');
    $r->get('/pacotes/novo',              'PacoteDeTurismoController@novo');
    $r->post('/pacotes/cadastrar',        'PacoteDeTurismoController@cadastrar');
    $r->get('/pacotes/{id:\d+}',          'PacoteDeTurismoController@buscar');
    $r->get('/pacotes/{id:\d+}/editar',   'PacoteDeTurismoController@editar');
    $r->post('/pacotes/{id:\d+}/remover', 'PacoteDeTurismoController@remover');

    // cronogramas
    $r->get('/cronogramas',                   'CronogramaController@listar');
    $r->get('/cronogramas/novo',              'CronogramaController@novo');
    $r->post('/cronogramas/cadastrar',        'CronogramaController@cadastrar');
    $r->get('/cronogramas/{id:\d+}',          'CronogramaController@buscar');
    $r->get('/cronogramas/{id:\d+}/editar',   'CronogramaController@editar');
    $r->post('/cronogramas/{id:\d+}/remover', 'CronogramaController@remover');

    // reservas
    $r->get('/reservas',                   'ReservaController@listar');
    $r->get('/reservas/novo',              'ReservaController@novo');
    $r->post('/reservas/cadastrar',        'ReservaController@cadastrar');
    $r->get('/reservas/{id:\d+}',          'ReservaController@buscar');
    $r->get('/reservas/{id:\d+}/editar',   'ReservaController@editar');
    $r->post('/reservas/{id:\d+}/remover', 'ReservaController@remover');

    // autenticação
    $r->get('/login',     'AuthController@login');
    $r->post('/login',    'AuthController@processarLogin');
    $r->get('/cadastro',  'AuthController@cadastro');
    $r->post('/cadastro', 'AuthController@processarCadastro');
    $r->get('/logout',    'AuthController@logout');

    // área do cliente
    $r->get('/minhas-viagens', 'MinhasViagensController@index');

    // portal administrativo
    $r->get('/portal', 'PortalController@listar');
});

$uri      = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = dirname($_SERVER['SCRIPT_NAME']);

if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

$uri = str_replace('/index.php', '', $uri);

if ($uri === '') {
    $uri = '/';
}

$method = $_SERVER['REQUEST_METHOD'];
$route  = $dispatcher->dispatch($method, $uri);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo "Página não encontrada: " . htmlspecialchars($uri);
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo "Método não permitido";
        break;

    case FastRoute\Dispatcher::FOUND:
        [$controllerClass, $action] = explode('@', $route[1]);
        $params = $route[2];

        $controllerNamespace = "controller\\{$controllerClass}";

        if (class_exists($controllerNamespace)) {
            $controller = new $controllerNamespace();
            $controller->$action($params);
        } else {
            echo "Controller {$controllerClass} não encontrado.";
        }
        break;
}