<?php


$requestUri = $_SERVER['REQUEST_URI'];


$requestUri = strtok($requestUri, '?');

// Define a function to handle the request and include the controller
function routeRequest($requestUri)
{
    // Define a base directory for controllers
    $controllersDir = __DIR__ . '/controller/';


    $routes = [
        '/' => 'landing_controller.php',

        // Add more routes as needed
    ];


    if (array_key_exists($requestUri, $routes)) {
        // Include the corresponding controller file
        $controllerFile = $controllersDir . $routes[$requestUri];
        if (file_exists($controllerFile)) {
            include($controllerFile);
        } else {
            // Handle 404 Not Found
            http_response_code(404);
            echo "404 Not Found";
        }
    } else {

        http_response_code(404);
        echo "404 Not Found";
    }
}

// Route the request
routeRequest($requestUri);
