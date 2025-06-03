<?php

header('Content-Type: application/json');

require_once '../database/connection.php';
require_once '../includes/helpers.php';
require_once '../models/ProductModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}


$product_id = $_POST['id'];

if (!$product_id) {
    sendResponse('error', 'No ID provided.');
}

try {
    $conn = getDBConnection();
    if (deleteProductById($conn, $product_id)) {
        sendResponse('success', 'Product deleted successfully.');
    }
    sendResponse('error', 'Error deleting product.');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
