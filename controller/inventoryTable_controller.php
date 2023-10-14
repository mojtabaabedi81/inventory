<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tirdad";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$productId = $_POST['productId'];
$productName = $_POST['productName'];
$productCategory = $_POST['productCategory'];
$productQuantity = $_POST['productQuantity'];
$productPrice = $_POST['productPrice'];

// Prepare and execute an SQL statement to insert the data into the database
$stmt = $conn->prepare("INSERT INTO inventory (product_id, product_name, category, quantity, price) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssid", $productId, $productName, $productCategory, $productQuantity, $productPrice);

if ($stmt->execute()) {
    echo "Item added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
