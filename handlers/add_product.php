<?php

header('Content-Type: application/json');

require_once '../includes/helpers.php';
require_once '../database/connection.php';
require_once '../models/ProductModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}

$product_title = htmlspecialchars(trim($_POST['product_title']));
$original_price = filter_var($_POST['original_price'], FILTER_VALIDATE_FLOAT);
$discounted_price = filter_var($_POST['discounted_price'], FILTER_VALIDATE_FLOAT);

if (!$original_price || !$discounted_price || !$product_title) {
    sendResponse('error', 'Invalid input data.');
}

if ($original_price < $discounted_price) {
    sendResponse('error', 'Discount price is higher than original price');
}

if ($_FILES['product_image']) {
    $imgTmp = $_FILES['product_image']['tmp_name'];
    $imgName = basename($_FILES['product_image']['name']);
    $targetDir = '../uploads/';
    $targetPath = $targetDir . $imgName;

    if (file_exists($imgName)) {
        sendResponse('error', 'File already exists.');
    }

    if (move_uploaded_file($imgTmp, $targetPath)) {
        try {
            $conn = getDBConnection();
            addProduct($conn, $imgName, $product_title, $original_price, $discounted_price);
            sendResponse('success', 'Product added successfully.');
        } catch (PDOException $e) {
            sendResponse('error', 'Database error.');
        }
    }

    sendResponse('error', 'Image upload failed or file not provided.');
}
