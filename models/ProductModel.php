<?php


function addProduct($conn, $category_id, $image_url, $title, $price, $discounted_price)
{
    $stmt = $conn->prepare(
        'INSERT INTO `products` (category_id, image_url, title, price, discounted_price) 
        VALUES (:category_id, :image_url, :title, :price, :discounted_price)'
    );
    return $stmt->execute([
        ':category_id' => $category_id,
        ':image_url' => $image_url,
        ':title' => $title,
        ':price' => $price,
        ':discounted_price' => $discounted_price,
    ]);
}

function getAllProducts($conn)
{
    $stmt = $conn->query('SELECT * FROM `products`');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteProductById($conn, $id)
{
    $stmt = $conn->prepare('DELETE FROM `products` WHERE id = :id');
    return $stmt->execute([':id'  => $id]);
}

function getProductById($conn, $id)
{
    $stmt = $conn->prepare('SELECT * FROM `products` WHERE id = :id');
    $stmt->execute([':id'  => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateProduct($conn, $id, $category_id,  $image_url, $title, $price, $discounted_price)
{
    $stmt = $conn->prepare(
        'UPDATE `products` 
        SET category_id = :category_id, 
        image_url = :image_url, 
        title = :title, price = :price, 
        discounted_price = :discounted_price  
        WHERE id = :id'
    );
    return $stmt->execute([
        ':category_id' => $category_id,
        ':image_url' => $image_url,
        ':title' => $title,
        ':price' => $price,
        ':discounted_price' => $discounted_price,
        'id' => $id,
    ]);
}

/* function getMultipleProductsByIds($conn, $productIds)
{
    // Creates (?, ?, ?) dynamically
    $placeholders = implode(',', array_fill(0, count($productIds), '?'));
    $stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($productIds);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} */
