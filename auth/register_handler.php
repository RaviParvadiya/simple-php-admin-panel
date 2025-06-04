<?php

header('Content-Type: application/json');

require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/AdminModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$errors = [];

if (empty($username)) {
    $errors['username'] = 'Username is required.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format.';
}
if (strlen($password) < 6) {
    $errors['password'] = 'Password must be at least 6 characters.';
}

if (!empty($errors)) {
    sendResponse('error', $errors);
}

try {
    $conn = getDBConnection();

    if (getUserByName($conn, $username)) {
        sendResponse('error', ['username' => 'User already exists']);
    }
    if (getUserByEmail($conn, $email)) {
        sendResponse('error', ['email' => 'Email already registered']);
    }

    $hashedPassword  = password_hash($password, PASSWORD_DEFAULT);
    createUser($conn, $username, $email, $hashedPassword);

    sendResponse('success', 'Registration successful!');
} catch (PDOException $e) {
    sendResponse('error', 'Database error occurred.');
}
