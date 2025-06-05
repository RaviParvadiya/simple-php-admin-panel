<?php

header('Content-Type: application/json');

require_once dirname(__DIR__) . '/config/config.php';
require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}

$id = trim($_POST['user_id']);
$name = htmlspecialchars(trim($_POST['user_name'] ?? ''));
$email = htmlspecialchars(trim($_POST['user_email'] ?? ''));

if (empty($id)) {
    sendResponse('error', 'Invalid user id.');
}
if (empty($name) || empty($email)) {
    sendResponse('error', 'Name and email are required.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendResponse('error', 'Invalid email format.');
}

try {
    $conn = getDBConnection();
    updateUser($conn, $id, $name, $email);
    sendResponse('success', 'User updated successfully.');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
