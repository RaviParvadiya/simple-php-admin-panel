<?php

function addCategory($conn, $name)
{
    $stmt = $conn->prepare('INSERT INTO `categories` (name) VALUES (:name)');
    return $stmt->execute([':name' => $name]);
}

function categoryExists($conn, $name)
{
    $stmt = $conn->prepare('SELECT count(*) FROM `categories` WHERE name = :name');
    $stmt->execute([':name' => $name]);
    return $stmt->fetchColumn() > 0;
}

function getAllCategories($conn)
{
    $stmt = $conn->query('SELECT * FROM `categories`');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCategoryById($conn, $id)
{
    $stmt = $conn->prepare('SELECT * FROM `categories` WHERE id = :id');
    $stmt->execute([':id'  => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteCategoryById($conn, $id)
{
    $stmt = $conn->prepare('DELETE FROM `categories` WHERE id = :id');
    return $stmt->execute([':id' => $id]);
}

function updateCategory($conn, $id, $name)
{
    $stmt = $conn->prepare(
        'UPDATE `categories` 
    SET `name` = :name 
    WHERE id = :id'
    );
    return $stmt->execute([
        ':name' => $name,
        'id' => $id,
    ]);
}
