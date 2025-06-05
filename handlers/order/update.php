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

$order_id = $_POST['order_id'];
$payment_method = $_POST['payment_method'] ?? '';
$payment_status = $_POST['payment_status'] ?? '';
$order_status = $_POST['order_status'] ?? '';
$products = $_POST['products'] ?? [];

if (empty($order_id)) {
    sendResponse('error', 'Order ID missing.');
}

if (empty($payment_method) || empty($payment_status) || empty($order_status)) {
    sendResponse('error', 'Please provide complete order info.');
}

if (empty($products)) {
    sendResponse('error', 'Please select at least one product.');
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
                'price' => $product['discounted_price']
            ];
        } else {
            sendResponse('error', 'Invalid product selected.');
        }
    }

    // Update main order details
    updateOrder($conn, $order_id, $payment_method, $payment_status, $order_status, $total_amount);

    // Remove old items
    $stmt = $conn->prepare('DELETE FROM order_items WHERE order_id = :order_id');
    $stmt->execute([':order_id' => $order_id]);

    // Insert updated items
    addOrderItem($conn, $order_id, $order_items);

    sendResponse('success', 'Order updated successfully!');
} catch (PDOException $e) {
    sendResponse('error', 'Database error.');
}
