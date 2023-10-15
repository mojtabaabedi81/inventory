<?php

function add_inventory()
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve data from the HTML form
        $productId = post('productId');
        $productName = post('productName');
        $productCategory = post('productCategory');
        $productQuantity = post('productQuantity');
        $productPrice = post('productPrice');

        global $conn;

        // Prepare an SQL statement for insertion
        $stmt = $conn->prepare("INSERT INTO inventory_table (product_id, product_name, product_category, product_quantity, product_price) VALUES (:productId, :productName, :productCategory, :productQuantity, :productPrice)");

        // Bind parameters
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':productCategory', $productCategory);
        $stmt->bindParam(':productQuantity', $productQuantity);
        $stmt->bindParam(':productPrice', $productPrice);

        // Execute the statement
        $stmt->execute();

        echo 'Data inserted successfully.';
    }
}
