<?php

function createOrder($conn, $user_id, $payment_method, $order_status, $payment_status, $total_amount)
{
    $stmt = $conn->prepare(
        'INSERT INTO `orders` (user_id, payment_method, order_status, payment_status, total_amount)
        VALUES (:user_id, :payment_method, :order_status, :payment_status, :total_amount)'
    );
    $stmt->execute([
        ':user_id' => $user_id,
        ':payment_method' => $payment_method,
        ':order_status' => $order_status,
        ':payment_status' => $payment_status,
        ':total_amount' => $total_amount,
    ]);
    return $conn->lastInsertId();
}

function getAllOrders($conn)
{
    $stmt = $conn->query(
        'SELECT 
            orders.*,
            users.name AS user_name
        FROM `orders`
        INNER JOIN `users` ON orders.user_id = users.id
        ORDER BY orders.order_date ASC;'
    );
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOrderById($conn, $id)
{
    $stmt = $conn->prepare(
        'SELECT orders.*, users.name AS user_name
        FROM `orders`
        INNER JOIN `users` ON users.id = orders.user_id
        WHERE orders.id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateOrder($conn, $order_id, $payment_method, $payment_status, $order_status, $total_amount)
{
    $stmt = $conn->prepare(
        'UPDATE orders
        SET payment_method = :payment_method,
            payment_status = :payment_status,
            order_status = :order_status,
            total_amount = :total_amount
        WHERE id = :id');
    return  $stmt->execute([
        ':payment_method' => $payment_method,
        ':payment_status' => $payment_status,
        ':order_status' => $order_status,
        ':total_amount' => $total_amount,
        ':id' => $order_id
    ]);
}

function deleteOrder($conn) {}

function addOrderItem($conn, $order_id, $items)
{
    $stmt = $conn->prepare(
        'INSERT INTO `order_items` (order_id, product_id, price) 
        VALUES (:order_id, :product_id, :price)'
    );

    foreach ($items as $item) {
        $stmt->execute([
            ':order_id' => $order_id,
            ':product_id' => $item['product_id'],
            ':price' => $item['price']
        ]);
    }
}

function updateOrderItem($orderItemId,  $data) {}

function removeOrderItem($orderItemId) {}

function getOrderDetails($conn, $order_id)
{
    $stmt = $conn->prepare(
        'SELECT 
            orders.id,
            orders.order_date,
            orders.payment_method,
            orders.payment_status,
            orders.order_status,
            orders.total_amount,
            users.name AS user_name,
            products.title AS product_title,
            products.image_url AS product_image,
            order_items.price
        FROM orders
        INNER JOIN users ON orders.user_id = users.id
        INNER JOIN order_items ON orders.id = order_items.order_id
        INNER JOIN products ON order_items.product_id = products.id
        WHERE orders.id = :order_id'
    );
    $stmt->execute([':order_id' => $order_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOrderProductIds($conn,  $order_id)
{
    $stmt = $conn->prepare('SELECT product_id FROM order_items WHERE order_id = :id');
    $stmt->execute(['id' => $order_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
