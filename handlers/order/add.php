<?php

header('Content-Type: application/json');

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once DATABASE_PATH . '/connection.php';
require_once INCLUDES_PATH . '/helpers.php';
require_once MODELS_PATH . '/OrderModel.php';
require_once MODELS_PATH . '/ProductModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Invalid request method.');
}

$user_id = $_POST['user_id'];
$payment_method = $_POST['payment_method'];
$payment_status = $_POST['payment_status'];
$order_status = $_POST['order_status'];
$products = $_POST['products'];

if (empty($user_id)) {
    sendResponse('error', 'User not selected.');
}

if (empty($payment_method) || empty($payment_status)) {
    sendResponse('error', 'Payment info not provided.');
}

if (empty($products)) {
    sendResponse('error', 'Please, check at least 1 product.');
}

$total_amount = 0;
$order_items = [];

try {
    $conn = getDBConnection();

    foreach ($products as $productId) {
        $product = getProductById($conn, $productId);

        if ($product) {
            $total_amount += $product['discounted_price'];
            $order_items[] = [
                'product_id' => $productId,
                'price' => $product['discounted_price'],
            ];
        } else {
            sendResponse('error', 'Product ' . $product['title'] . ' not found.');
        }
    }

    // $productList = getMultipleProductsByIds($conn, $products); // array of selected products

    $order_id = createOrder($conn, $user_id, $payment_method, $order_status, $payment_status, $total_amount);
    addOrderItem($conn, $order_id, $order_items);
    sendResponse('success', 'Order added successfully!');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
