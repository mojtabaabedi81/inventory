<?php

function create_product($user_id, $product_name, $product_no, $product_category, $product_quantity, $product_price): bool
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
    $query = "SELECT * FROM inventory_table WHERE id = $id";
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

function get_product_list($user_id, $sheet)
{
    global $conn;
    $query = "SELECT * FROM inventory_table WHERE user_id = $user_id";
    $stmt = $conn->query($query);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rowCount = 2;
    foreach ($row as $item) {
        $sheet->setCellValue('C' . $rowCount, 'product_no  :' . $item['product_no']);
        $sheet->setCellValue('D' . $rowCount, 'product_name :' . $item['product_name']);
        $sheet->setCellValue('E' . $rowCount, 'product_category :' . $item['product_category']);
        $sheet->setCellValue('F' . $rowCount, 'product_quantity :' . $item['product_quantity']);
        $sheet->setCellValue('G' . $rowCount, 'created_at :' . $item['created_at']);
        $rowCount++;


    }
}
