<?php
session_start();

require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/helper/helper.php";
require_once __DIR__ . "/middleware/auth_middleware.php";
require_once __DIR__ . "/database/database.php";
require_once __DIR__ . "/model/user_model.php";
require_once __DIR__ . "/model/inventory_model.php";
require_once __DIR__ . "/database/migration.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
require __DIR__ . "/vendor/autoload.php";

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
        die('something went wrong');
    }
}



