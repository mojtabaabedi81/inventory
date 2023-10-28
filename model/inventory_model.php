<?php

function create_product($user_id,$product_name, $product_no, $product_category, $product_quantity, $product_price): bool
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO inventory_table (user_id, product_no, product_name, product_category , product_quantity , product_price ,created_at) VALUES (:user_id,:product_no, :product_name, :product_category, :product_quantity, :product_price,NOW())");

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':product_no', $product_no);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':product_category', $product_category);
    $stmt->bindParam(':product_quantity', $product_quantity);
    $stmt->bindParam(':product_price', $product_price);


    return $stmt->execute();
}

function get_all_product($user_id)
{
    global $conn;
    $query = "SELECT * FROM inventory_table where user_id = $user_id ";
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

function delete_by_id_product($id): bool
{
    global $conn;
    $query = "DELETE FROM inventory_table WHERE id = :id";
    $stmt = $conn->prepare($query);

    return $stmt->execute(['id' => $id]);
}

function edit_product($product_no, $product_name, $product_category, $product_quantity, $product_price, $id): bool
{
    global $conn;
    $sql = "UPDATE inventory_table SET product_no = :product_no,
                           product_name = :product_name,
                           product_category = :product_category,
                           product_quantity = :product_quantity,
                           product_price = :product_price,
                           created_at = Now()
                           WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':product_no', $product_no);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':product_category', $product_category);
    $stmt->bindParam(':product_quantity', $product_quantity);
    $stmt->bindParam(':product_price', $product_price);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();

}
