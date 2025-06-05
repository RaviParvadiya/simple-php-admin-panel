<?php

header('Content-Type: application/json');

require_once dirname(__DIR__) . '/config/config.php';
require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/CategoryModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}

$id = trim($_POST['category_id']);
$name = htmlspecialchars(trim($_POST['category_name']));

if (empty($id)) {
    sendResponse('error', 'Invalid category id.');
}
if (empty($name)) {
    sendResponse('error', 'Invalid input data.');
}


try {
    $conn = getDBConnection();
    updateCategory($conn, $id, $name);
    sendResponse('success', 'Category updated successfully.');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
