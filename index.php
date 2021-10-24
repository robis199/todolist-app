<?php
require_once 'vendor/autoload.php';
use App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

session_start();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->get('/tasks', 'TasksController-index');
    $r->post('/tasks', 'TasksController-store');
    $r->get('/tasks/create', 'TasksController-search');
    $r->post('/tasks/{id}', 'TasksController-delete');

    $r->post( '/registration', 'AuthController-register');
    $r->get( '/registration', 'AuthController-registrationForm');
    $r->post( '/login', 'AuthController-login');
    $r->get( '/login', 'AuthController-loginForm');
    $r->get( '/welcome', 'AuthController-logInSuccessful');
    $r->get( '/user', 'AuthController-userInfo');
    $r->post('/user', 'AuthController-logout');
});

$twig = new Environment(new FilesystemLoader("app/Views"), []);


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

        $path = 'App\Controllers\\' . $handler;
        $controller = new $path();
        $render = $controller->$method($vars);

        if ($render instanceof View) {

            echo $twig->render(
                /** $var View $response */
                $render->getPath(),
                $render->getData()
            );
        }

        break;
}

unset($_SESSION['errors']);