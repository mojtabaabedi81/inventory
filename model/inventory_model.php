<?php

function create_product($product_name, $product_no, $product_category, $product_quantity, $product_price): bool
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO inventory_table (product_no, product_name, product_category , product_quantity , product_price ,created_at) VALUES (:product_no, :product_name, :product_category, :product_quantity, :product_price,NOW())");

    $stmt->bindParam(':product_no', $product_no);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':product_category', $product_category);
    $stmt->bindParam(':product_quantity', $product_quantity);
    $stmt->bindParam(':product_price', $product_price);


    return $stmt->execute();
}

function get_all_product()
{
    global $conn;
    $query = "SELECT * FROM inventory_table";
    $stmt = $conn->query($query);


    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_by_id_product($id)
{
    global $conn;
    $query = 'SELECT * FROM inventory_table WHERE id = "$id"';
    $stmt = $conn->query($query);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function delete_by_id_product($product_no): bool
{
    global $conn;
    $query = "DELETE FROM inventory_table WHERE product_no = :product_no";
    $stmt = $conn->prepare($query);

    return $stmt->execute(['product_no' => $product_no]);
}

function edit_product($product_no, $product_name, $product_category, $product_quantity, $product_price): bool
{
    global $conn;
    $stmt = $conn->prepare("UPDATE inventory_table SET (product_no, product_name, product_category , product_quantity , product_price ,created_at) 
                       VALUES (:product_no, :product_name, :product_category, :product_quantity, :product_price,NOW())");
    $stmt->bindParam(':product_no', $product_no);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':product_category', $product_category);
    $stmt->bindParam(':product_quantity', $product_quantity);
    $stmt->bindParam(':product_price', $product_price);

    return $stmt->execute();

}
