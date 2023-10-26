<?php

function create_product($productName, $productId, $productCategory, $productQuantity, $productPrice): bool
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO inventory_table (productId, productName, productCategory , productQuantity , productPrice ,inserted_at) VALUES (:productId, :productName, :productCategory, :productQuantity, :productPrice,NOW())");

    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':productName', $productName);
    $stmt->bindParam(':productCategory', $productCategory);
    $stmt->bindParam(':productQuantity', $productQuantity);
    $stmt->bindParam(':productPrice', $productPrice);


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

function delete_by_id_product($productId): bool
{
    global $conn;
    $query = "DELETE FROM inventory_table WHERE productId = :productId";
    $stmt = $conn->prepare($query);

    return $stmt->execute(['productId' => $productId]);
}

function edit_product($productId, $productName, $productCategory, $productQuantity, $productPrice): bool
{
    global $conn;
    $stmt = $conn->prepare("UPDATE inventory_table SET (productId, productName, productCategory , productQuantity , productPrice ,inserted_at) 
                       VALUES (:productId, :productName, :productCategory, :productQuantity, :productPrice,NOW())");
    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':productName', $productName);
    $stmt->bindParam(':productCategory', $productCategory);
    $stmt->bindParam(':productQuantity', $productQuantity);
    $stmt->bindParam(':productPrice', $productPrice);

    return $stmt->execute();

}
