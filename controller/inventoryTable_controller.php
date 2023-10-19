<?php

function add_inventory()
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $productName = post('productName');
        $productId = post('productId');
        $productCategory = post('productCategory');
        $productQuantity = post('productQuantity');
        $productPrice = post('productPrice');

       add_sql($productName,$productId,$productCategory,$productQuantity,$productPrice);

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

function delete_inventory($data)
{
    global $conn;
    $productId = post('productId');
    $query = "DELETE FROM inventory_table WHERE product_id = :product_id";
    $stmt = $conn->prepare($query);
//    $stmt->bindParam("s" , $productId);

    if ($stmt->execute(['product_id' => $productId])) {
        echo json_encode(array('message' => 'Item deleted successfully'));
    } else {
        echo json_encode(array('message' => 'Item deletion failed'));
    }
}


