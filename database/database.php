<?php
require "./config/config.php";
try {
    // Create a PDO connection to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
