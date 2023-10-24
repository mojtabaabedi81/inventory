<?php
try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
