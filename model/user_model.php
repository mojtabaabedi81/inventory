<?php

function create_user($email,$password)
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

function add_sql($productName ,$productId,$productCategory,$productQuantity,$productPrice)
{
    global $conn;


    $stmt = $conn->prepare("INSERT INTO inventory_table (product_id, product_name, product_category, product_quantity, product_price,inserted_at) VALUES (:productId, :productName, :productCategory, :productQuantity, :productPrice,NOW())");


    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':productName', $productName);
    $stmt->bindParam(':productCategory', $productCategory);
    $stmt->bindParam(':productQuantity', $productQuantity);
    $stmt->bindParam(':productPrice', $productPrice);


    $stmt->execute();

}

function fetch_sql ()
{
    global $conn;
    global $stmt;

    $query = "SELECT * FROM inventory_table";
    $stmt = $conn->query($query);
}
function delete_sql ($productId)
{
    global $conn;
    global $stmt;
    $query = "DELETE FROM inventory_table WHERE product_id = :product_id";
    $stmt = $conn->prepare($query);
}
