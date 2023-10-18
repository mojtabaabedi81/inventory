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

    return $conn->prepare($query);
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

    return $conn->prepare($query);
}
