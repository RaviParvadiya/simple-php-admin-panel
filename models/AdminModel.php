<?php


function createUser(PDO $conn, string $username, string $email, string $password): bool
{
    $stmt = $conn->prepare('INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)');
    return $stmt->execute([':username' => $username, ':email' => $email, ':password' => $password]);
}

function getUserByEmail(PDO $conn, string $email): ?array
{
    $stmt = $conn->prepare('SELECT * FROM admins WHERE email = :email');
    $stmt->execute([':email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function getUserByName(PDO $conn, string $username): ?array
{
    $stmt = $conn->prepare('SELECT * FROM admins WHERE username = :username');
    $stmt->execute([':username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function getUserById($conn, $id) {}
