<?php

header('Content-Type: application/json');

require_once dirname(__DIR__) . '/config/config.php';
require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/AdminModel.php';
require_once INCLUDES_PATH . '/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
    sendResponse('error', 'Invalid email or password');
}

try {
    $conn = getDBConnection();
    $user = getUserByEmail($conn, $email);

    if (!$user || !password_verify($password, $user['password'])) {
        sendResponse('error', 'Invalid email or password');
    }
    startSession();
    setSession('admin_id', $user['id']);
    sendResponse('success', 'Logged in successfully');
} catch (PDOException $e) {
    sendResponse('error', 'Database error');
}
