<?php

header('Content-Type: application/json');

require_once dirname(__DIR__) . '/config/config.php';
require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/UserModel.php';

if (!isset($_POST['user_name'])) {
    sendResponse('error', 'Invalid data');
}

$name = trim($_POST['user_name'] ?? '');
$email = trim($_POST['user_email'] ?? '');

if (empty($name) || empty($email)) {
    sendResponse('error', 'Name and email are required.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendResponse('error', 'Invalid email format.');
}

try {
    $conn = getDBConnection();

    if (emailExists($conn, $email)) {
        sendResponse('error', 'Email already exists.');
    }

    if (addUser($conn, $name, $email)) {
        sendResponse('success', 'User added successfully.');
    }

    sendResponse('error', 'Failed to add user.');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
