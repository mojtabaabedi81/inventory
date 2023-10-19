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

    $query = "
    CREATE TABLE inventory (
    id int NOT NULL AUTO_INCREMENT,
    productID text,
    productName varchar(256),
    category int,
    quantity int,
    price datetime,
    primary key (id)
    );
    ";

    return $conn->query($query);
}

function createTableIfNotExist()
{
    global $conn;

    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result-> rowCount() == 0){

        create_users_table();
    }
    $result = $conn->query("SHOW TABLES LIKE 'inventory_table'");
    if ($result->rowCount() == 0 ){
        create_inventory_table();
    }

}


