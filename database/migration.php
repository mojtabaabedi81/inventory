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

    return mysqli_query($conn, $query);
}


function create_todo_table()
{
    global $conn;

    $query = "
    CREATE TABLE todo (
    id int NOT NULL AUTO_INCREMENT,
    name text,
    email varchar(256),
    user_id int,
    status int,
    created_at datetime,
    primary key (id)
    );
    ";

    return mysqli_query($conn, $query);
}