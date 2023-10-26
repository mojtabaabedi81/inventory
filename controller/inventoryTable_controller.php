<?php

function show()
{
    $data = get_all_product();
    view("inventory_form", $data);
}

function add_product()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $product_name = post('product_name');
        $product_no = post('product_no');
        $product_category = post('product_category');
        $product_quantity = post('product_quantity');
        $product_price = post('product_price');

        create_product($product_name, $product_no, $product_category, $product_quantity, $product_price);

        header("Location:../inventoryTable/show");
        exit();
    }
}

function delete_product($data)
{
    $product_no = post('product_no');

    if (delete_by_id_product($product_no)) {
        msg_success('Item deleted successfully');
    } else {
        msg_error('Item deletion failed');
    }
}

function edit_item()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $product_name = post('product_name');
        $product_no = post('product_no');
        $product_category = post('product_category');
        $product_quantity = post('product_quantity');
        $product_price = post('product_price');

        edit_product($product_name, $product_no, $product_category, $product_quantity, $product_price);

        header("Location:../inventoryTable/show");
        exit();
    }
}

