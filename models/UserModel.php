<?php

function addUser($conn, $name, $email)
{
    $stmt = $conn->prepare('INSERT INTO `users` (name, email) VALUES (:name, :email)');
    return $stmt->execute([':name' => $name, ':email' => $email]);
}

function emailExists($conn, $email)
{
    $stmt = $conn->prepare('SELECT count(*) FROM `users` WHERE email = :email');
    $stmt->execute([':email' => $email]);
    return $stmt->fetchColumn() > 0;
}

function getAllUsers($conn)
{
    $stmt = $conn->query('SELECT * FROM `users`');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById($conn, $id)
{
    $stmt = $conn->prepare('SELECT * FROM `users` WHERE id = :id');
    $stmt->execute([':id'  => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteUserById($conn, $id)
{
    $stmt = $conn->prepare('DELETE FROM `users` WHERE id = :id');
    return $stmt->execute([':id' => $id]);
}

function updateUser($conn, $id, $name, $email)
{
    $stmt = $conn->prepare(
        'UPDATE `users` 
    SET `name` = :name, `email` = :email
    WHERE id = :id'
    );
    return $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        'id' => $id,
    ]);
}
