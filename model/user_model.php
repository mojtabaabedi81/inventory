<?php

function create_user($email, $password)
{
    global $conn;
    $sql = "INSERT INTO users ( password, email) VALUES (:password , :email)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'password' => $password,
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


function get_user_id($email)
{
    global $conn;
    $email = $_SESSION['user_email'];
    $query = "SELECT id FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->execute([
        'email' => $email
    ]);
    return $stmt->fetch();

}