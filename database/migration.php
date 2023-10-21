<?php


function create_users_table($query)
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


function create_inventory_table($query)
{
    global $conn;

    $query = "CREATE TABLE IF NOT EXISTS `inventory_table` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(256) NOT NULL,
  `product_category` varchar(256) NOT NULL,
  `product_quantity` varchar(256) NOT NULL,
  `product_price` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `inserted_at` datetime NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

    return $conn->query($query);
}

function createTableIfNotExist()
{
    global $conn;

    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result-> rowCount() == 0){

        create_users_table($query);
    }
    $result = $conn->query("SHOW TABLES LIKE 'inventory_table'");
    if ($result->rowCount() == 0 ){
        create_inventory_table($query);
    }

}


