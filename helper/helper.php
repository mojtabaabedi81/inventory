<?php
function dd ($data)
{
    echo "<pre style='background-color: black; color: #dedede'>";
    echo json_encode($data);
    echo "</pre>";
    die();
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