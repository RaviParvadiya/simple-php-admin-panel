<?php

header('Content-Type: application/json');

require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/UserModel.php';

if (!isset($_POST['id'])) {
    sendResponse('error', 'Invalid request method.');
}

$id = trim($_POST['id']);

try {
    $conn = getDBConnection();
    if (deleteUserById($conn, $id)) {
        sendResponse('success', 'User deleted successfully.');
    }
    sendResponse('error', 'Error deleting user.');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
