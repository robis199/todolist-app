<?php


use App\Templates\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';



session_start();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->get('/', 'TasksController-index');
    $r->get('/tasks', 'TasksController-index');
    $r->get('/tasks/create', 'TasksController-create');
    $r->post('/tasks', 'TasksController-store');
    $r->post('/tasks/{id}', 'TasksController-delete');
    $r->get('/tasks/{id}', 'TasksController-show');


    $r->get( '/users', 'LogInController-showLogins');
    $r->get( '/login', 'LogInController-login');
    $r->post( '/login', 'LogInController-login');
    $r->get( '/success', 'LogInController-loginSuccess');
    $r->get( '/logout', 'LogInController-logout');

    $r->get( '/record', 'LogInController-userRegister');
    $r->post('/record', 'LogInController-userRegister');
    $r->get( '/records', 'LogInController-registerSuccessful');


});

function base_path(): string
{
    return __DIR__;

}

$loader = new FilesystemLoader('app/Templates');
$templateEngine = new Environment($loader, []);
$templateEngine->addGlobal('session', $_SESSION);

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0])
{

    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = explode('-', $handler);

        $controller = 'App\Controllers\\' . $controller;
        $controller = new $controller();
        $render = $controller->$method($vars);


        if ($render instanceof View) {
            try {
                echo $templateEngine->render($render->getTemplate(), $render->getVariables());
            } catch (\Twig\Error\LoaderError | \Twig\Error\RuntimeError | \Twig\Error\SyntaxError $e) {
            }
        }

        break;
}

unset($_SESSION['user_name']);