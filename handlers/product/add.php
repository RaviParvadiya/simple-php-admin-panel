<?php

header('Content-Type: application/json');

require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/ProductModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}

$category_id = htmlspecialchars(trim($_POST['category_id']));
$title = htmlspecialchars(trim($_POST['product_title']));
$price = filter_var($_POST['original_price'], FILTER_VALIDATE_INT);
$discounted_price = filter_var($_POST['discounted_price'], FILTER_VALIDATE_INT);

if (!$price || !$discounted_price || !$title) {
    sendResponse('error', 'Invalid input data.');
}

if ($price < $discounted_price) {
    sendResponse('error', 'Discount price is higher than original price');
}

if ($_FILES['product_image']) {
    $imgTmp = $_FILES['product_image']['tmp_name'];
    $imgName = basename($_FILES['product_image']['name']);
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/simple/uploads/';
    $targetPath = $targetDir . $imgName;

    /*     if (file_exists($imgName)) {
        sendResponse('error', 'File already exists.');
    }
 */
    if (move_uploaded_file($imgTmp, $targetPath)) {
        try {
            $conn = getDBConnection();
            addProduct($conn, $category_id, $imgName, $title, $price, $discounted_price);
            sendResponse('success', 'Product added successfully.');
        } catch (PDOException $e) {
            sendResponse('error', 'Database error.');
        }
    }

    sendResponse('error', 'Image upload failed or file not provided.');
}
