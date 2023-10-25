<?php
function dd(...$value) {
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}


function user_validation(){

}

function post($key)
{
    if (empty($_POST["$key"])){
        return false;
    }
    return prepare_data($_POST["$key"]);
}

function get($key)
{
    return prepare_data($_GET["$key"]);
}



function prepare_data($data)
{
    return trim(htmlspecialchars($data));
}
function view($view_name , $data = null)
{
    include __DIR__ ."/../template/$view_name" .".php";
}
function validate_password($password): bool
{

    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase) {
        return false;
    }
    return true;
}
function validate_email($email)
{
   return filter_var($email, FILTER_VALIDATE_EMAIL);
}