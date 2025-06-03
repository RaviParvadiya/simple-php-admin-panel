<?php


function addProduct($conn, $product_image, $product_title, $original_price, $discounted_price)
{
    $stmt = $conn->prepare('INSERT INTO `products` (product_image, product_title, original_price, discounted_price) 
                            VALUES (:product_image, :product_title, :original_price, :discounted_price)');
    return $stmt->execute([
        ':product_image' => $product_image,
        ':product_title' => $product_title,
        ':original_price' => $original_price,
        ':discounted_price' => $discounted_price,
    ]);
}

function getAllProducts($conn)
{
    $stmt = $conn->query('SELECT * FROM `products`');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteProductById($conn, $product_id)
{
    $stmt = $conn->prepare('DELETE FROM `products` WHERE product_id = :product_id');
    return $stmt->execute([':product_id'  => $product_id]);
}
