<?php

header('Content-Type: application/json');

require_once dirname(__DIR__) . '/config/config.php';
require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/CategoryModel.php';

if (!isset($_POST['id'])) {
    sendResponse('error', 'Invalid request method.');
}

$id = trim($_POST['id']);

try {
    $conn = getDBConnection();
    if (deleteCategoryById($conn, $id)) {
        sendResponse('success', 'Category deleted successfully.');
    }
    sendResponse('error', 'Error deleting category.');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
