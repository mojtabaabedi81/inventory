<?php

$url = trim($_SERVER['REQUEST_URI'], '/');
$path = !empty($url) ? $url : "user/login";

$loggedin = !empty($_SESSION['user_email']) ? 1 : 0;


if (preg_match('/^inventory\/*/i', $path)) {
    if (!$loggedin) {
        header('Location: ' . BASEURL . '/user/login');
        exit();
    }
}

if (preg_match('/^user\/(login|register)/i', $path) || empty($path)) {
    if ($loggedin) {

        header('Location: ' . BASEURL . 'inventoryTable/show');
        die();
    }
}