<?php
error_reporting(E_ALL & ~E_WARNING);
require_once __DIR__ . "/database/database.php";
require_once __DIR__ . "/helper/helper.php";
require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/model/user_model.php";
require_once __DIR__ . "/database/migration.php";

createTableIfNotExist();



if (isset($_SERVER['REQUEST_URI'])) {
    $url = trim($_SERVER['REQUEST_URI'], '/');
    $path = !empty($url) ? $url : "user/login";

    $query_params = explode('?', $path);


    if (!empty($query_params[1])) {
        $path = explode('?', $path);
    }
    list($controller, $method) = explode('/', $path);

    $file = __DIR__ . "/controller/{$controller}_controller.php";
    if (file_exists($file)) {
        require $file;
        $method($_REQUEST);
    } else {
        $server_path = getcwd();
        $root_name = basename($server_path);


        list($controller, $method) = explode('/', $server_path);
        $file = __DIR__ . "/controller/user_controller.php";
        $method = "login";

        if (file_exists($file)) {
            require $file;
            $method($_REQUEST);
        } else {
            die('something went wrong');
        }

    }
}



