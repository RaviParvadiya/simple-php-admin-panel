<?php

header('Content-Type: application/json');

require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/ProductModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}


$id = trim($_POST['id']);

if (!$id) {
    sendResponse('error', 'No ID provided.');
}

try {
    $conn = getDBConnection();
    if (deleteProductById($conn, $id)) {
        sendResponse('success', 'Product deleted successfully.');
    }
    sendResponse('error', 'Error deleting product.');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
