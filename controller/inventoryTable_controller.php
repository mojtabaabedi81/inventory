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
        $stmt = $conn->prepare("INSERT INTO inventory_table (product_id, product_name, product_category, product_quantity, product_price,inserted_at) VALUES (:productId, :productName, :productCategory, :productQuantity, :productPrice,NOW())");

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

function fetch_from_database()
{
    global $conn;

    $query = "SELECT * FROM inventory_table";
    $stmt = $conn->query($query);

    // Fetch the inventory items
    $inventoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $inventoryData;
}
