<?php



require_once 'vendor/autoload.php';


session_start();



$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->get('/', 'TasksController-index');
    $r->get('/tasks', 'TasksController-index');
    $r->get('/tasks/create', 'TasksController-create');
    $r->post('/tasks', 'TasksController-store');
    $r->post('/tasks/{id}', 'TasksController-delete');
    $r->get('/tasks/{id}', 'TasksController-show');


    $r->get( '/login', 'UsersController-userLogin');
    $r->post( '/login', 'UsersController-login');
    $r->get( '/success', 'UsersController-loginSuccess');
    $r->get( '/logout', 'UsersController-logout');

    $r->get( '/record', 'UsersController-userRegister');
    $r->post('/record', 'UsersController-record');
    $r->get( '/records', 'UsersController-registerSuccessful');

    $r->get( '/users', 'UsersController-showUserLogin');

});

function base_path(): string
{
    return __DIR__;

}


// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
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

        $controller= 'App\Controllers\\' . $controller;
        $controller = new $controller();
        $controller->$method($vars);

        break;
}