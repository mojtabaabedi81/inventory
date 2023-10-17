<?php

function add_inventory()
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $productId = post('productId');
        $productName = post('productName');
        $productCategory = post('productCategory');
        $productQuantity = post('productQuantity');
        $productPrice = post('productPrice');

        global $conn;


        $stmt = $conn->prepare("INSERT INTO inventory_table (product_id, product_name, product_category, product_quantity, product_price,inserted_at) VALUES (:productId, :productName, :productCategory, :productQuantity, :productPrice,NOW())");


        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':productCategory', $productCategory);
        $stmt->bindParam(':productQuantity', $productQuantity);
        $stmt->bindParam(':productPrice', $productPrice);


        $stmt->execute();

        echo 'Data inserted successfully.';
    }
}

function fetch_from_database()
{
    global $conn;

    $query = "SELECT * FROM inventory_table";
    $stmt = $conn->query($query);


    $inventoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $inventoryData;
}

function delete_inventory()
{
    global $conn;

    $query = "DELETE FROM inventory WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam("s" , $productId);

    if ($stmt->execute()) {
        echo json_encode(array('message' => 'Item deleted successfully'));
    }else {
        echo json_encode(array('message'=>'Item deletion failed'));
    }
}