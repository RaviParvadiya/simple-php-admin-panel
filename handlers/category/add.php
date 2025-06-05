<?php

header('Content-Type: application/json');

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/CategoryModel.php';

if (!isset($_POST['category_name'])) {
    sendResponse('error', 'Invalid data');
}

$name = trim($_POST['category_name'] ?? '');

if (empty($name)) {
    sendResponse('error', 'Category name is required.');
}

try {
    $conn = getDBConnection();

    if (categoryExists($conn, $name)) {
        sendResponse('error', 'Category already exists.');
    }

    if (addCategory($conn, $name)) {
        sendResponse('success', 'Category added successfully.');
    }

    sendResponse('error', 'Failed to add category.');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
