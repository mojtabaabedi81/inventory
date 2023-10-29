<?php

function show()
{
    $email = $_SESSION['user_email'];
    $id = (get_user_id($email));
    $user_id = $id['id'];
    $data = get_all_product($user_id);
    view("inventory_form", $data);
}

function add_product()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        required([
            post('product_name'),
            post('product_no'),
            post('product_category'),
            post('product_quantity'),
            post('product_price'),
        ], '/inventoryTable/show');

        $email = $_SESSION['user_email'];
        $id = (get_user_id($email));
        $user_id = $id['id'];
        $product_name = post('product_name');
        $product_no = post('product_no');
        $product_category = post('product_category');
        $product_quantity = post('product_quantity');
        $product_price = post('product_price');

        create_product($user_id, $product_name, $product_no, $product_category, $product_quantity, $product_price);

        header("Location:" . BASEURL . '/inventoryTable/show');
        exit();
    }
}

function delete_product()
{
    $product_id = post('id');

    if (delete_by_id_product($product_id)) {
        msg_success('Item deleted successfully');
    } else {
        msg_error('Item deletion failed');
    }
}

function edit_item()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = $_SESSION['user_email'];
        $id = (get_user_id($email));
        $user_id = $id['id'];

        required([
            post('product_name'),
            post('product_no'),
            post('product_category'),
            post('product_quantity'),
            post('product_price'),
        ], '/inventoryTable/show');

        $product_name = post('product_name');
        $product_no = post('product_no');
        $product_category = post('product_category');
        $product_quantity = post('product_quantity');
        $product_price = post('product_price');
        $id = post('id');

        edit_product($product_name, $product_no, $product_category, $product_quantity, $product_price, $id);

        header("Location:" . BASEURL . "/inventoryTable/show");
        exit();
    }
}

function excel_export()
{
    $email = $_SESSION['user_email'];
    $id = get_user_id($email);
    $user_id = $id['id'];

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    get_product_list($user_id,$sheet);
    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attactment; filename="'.urlencode('demo.xlsx').'"');
    $writer->save("php://output");

}

