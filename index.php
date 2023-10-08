<?php
function NotFoundPage()
{
    header("HTTP/1.0 404 NOT Found");
    echo "404 - page not Found!";
}


$requestURI = $_SERVER['REQUEST_URI'];

$urlPart = parse_url($requestURI);
$path = $urlPart['path'];
$routes = [
    '/' => 'landing_controller@index',
    '/register'=> 'registerPage',
];

if (array_key_exists($path , $routes)){
    $routeParts = explode('@',$routes[$path]);
    $controllerName = $routeParts[0];
    $methodName = $routeParts[1];
    require_once (__DIR__ . 'landing_controller\\' . $controllerName . '.php');
    $controller = new $controllerName ();
    $controller->$methodName();
}else {
    NotFoundPage();
}
