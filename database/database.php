<?php
try {

    $dsn = "mysql:host={$servername};dbname=" . $dbname;
    $conn = new PDO($dsn, $username, $pass);

} catch (PDOException $e) {
    die("cant connect to database");
}
