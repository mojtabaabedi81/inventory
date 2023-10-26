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
    product_no int,
    product_name varchar(256),
    product_category varchar(256),
    product_quantity int,
    product_price int,
    created_at datetime,
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


