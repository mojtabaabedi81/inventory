<?php
function create_user($firstname , $password, $email)
{
    global $conn;
    $sql = "INSERT INTO users (name, lastname, password, email ) values (:name  , :password , :email)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'name' => $firstname,
        'password' => $password,
        'email' => $email,
    ]);
    return $stmt->rowcount();
}

function user_login($email, $password)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE `email` = :email AND `password`= :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'password' => md5($password),
        'email' => $email
    ]);
    return $stmt->fetch();
}


function user_exists($email)
{

    global $conn;

    $sql = "SELECT * FROM users WHERE email = :email ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'email' => $email,
    ]);

    return $stmt->rowcount();
}