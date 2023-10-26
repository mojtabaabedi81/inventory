<?php

function show()
{
    $data = get_all_product();
    view("inventory_form", $data);
}

function add_product()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $productName = post('productName');
        $productId = post('productId');
        $productCategory = post('productCategory');
        $productQuantity = post('productQuantity');
        $productPrice = post('productPrice');

        create_product($productName, $productId, $productCategory, $productQuantity, $productPrice);

        header("Location:../inventoryTable/show");
        exit();
    }
}

function delete_product($data)
{
    $productId = post('productId');

    if (delete_by_id_product($productId)) {
        msg_success('Item deleted successfully');
    } else {
        msg_error('Item deletion failed');
    }
}

function edit_item()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $productName = post('productName');
        $productId = post('productId');
        $productCategory = post('productCategory');
        $productQuantity = post('productQuantity');
        $productPrice = post('productPrice');

        edit_product($productName, $productId, $productCategory, $productQuantity, $productPrice);

        header("Location:../inventoryTable/show");
        exit();
    }
}

