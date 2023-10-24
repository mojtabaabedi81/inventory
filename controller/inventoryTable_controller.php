<?php

function show()
{
    view("inventory_form");
}

function add_inventory()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $productName = post('productName');
        $productId = post('productId');
        $productCategory = post('productCategory');
        $productQuantity = post('productQuantity');
        $productPrice = post('productPrice');

        add_sql($productName, $productId, $productCategory, $productQuantity, $productPrice);

        header("Location:../inventoryTable/show");

    }
}

function fetch_from_database()
{
    global $conn;

    fetch_sql();
    global $stmt;
    $inventoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $inventoryData;
}

function delete_inventory($data)
{
    global $conn;
    global $stmt;
    $productId = post('productId');
    delete_sql($productId);


    if ($stmt->execute(['productId' => $productId])) {
        echo json_encode(array('message' => 'Item deleted successfully'));
    } else {
        echo json_encode(array('message' => 'Item deletion failed'));
    }
}

function logout()
{
    header('Location: ' . BASEURL . 'user/login');
}


