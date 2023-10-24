<?php


function create_users_table()
{
    global $conn;

    $query = "
    CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    name text,
    email varchar(256),
    password text,
    primary key (id)
    );

     ";

    return $conn->query($query);
}


function create_inventory_table()
{
    global $conn;

    $query = "CREATE TABLE inventory_table (
    id int NOT NULL AUTO_INCREMENT,
    productId text,
    productName varchar(256),
    productCategory varchar(256),
    productQuantity int,
    productPrice int,
    inserted_at datetime,
    primary key (id)
)";


    return $conn->query($query);
}

function createTableIfNotExist()
{
    global $conn;

    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result->rowCount() == 0) {

        create_users_table();
    }
    $result = $conn->query("SHOW TABLES LIKE 'inventory_table'");
    if ($result->rowCount() == 0) {
        create_inventory_table();
    }

}


