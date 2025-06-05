<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

checkUserSession();

?>

<?php

require_once DATABASE_PATH . '/connection.php';
require_once MODELS_PATH . '/UserModel.php';
require_once MODELS_PATH . '/ProductModel.php';
require_once MODELS_PATH . '/OrderModel.php';

$orderId = (int) $_GET['id'];
$errorMessage = null;
$order = null;
$products = [];
$users = [];
$selectedProducts = [];

try {
    $conn = getDBConnection();
    $order = getOrderById($conn, $orderId);
    $users = getAllUsers($conn);
    $products = getAllProducts($conn);
    $selectedProducts = getOrderProductIds($conn, $orderId); // Fetch product IDs for this order
} catch (PDOException $e) {
    $errorMessage = "<div class='error'>Sorry, we're experiencing technical difficulties. Please try again later.</div>";
}

?>

<?php include INCLUDES_PATH . '/partials/header.php'; ?>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include INCLUDES_PATH . '/partials/sidebar.php' ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <?php include INCLUDES_PATH . '/partials/topbar.php' ?>
        <!--  Header End -->
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Edit Order #<?= htmlspecialchars($orderId) ?></h5>
                        <div class="card">
                            <div class="card-body">
                                <?php if ($errorMessage) { ?>
                                    <div class="alert alert-danger"><?= $errorMessage ?></div>
                                <?php } elseif (!empty($products)) { ?>
                                    <form id="editOrderForm" action="#" method="post">
                                        <input type="hidden" name="order_id" value="<?= $orderId ?>">

                                        <div class="mb-3">
                                            <label class="form-label">User</label>
                                            <input type="text" class="form-control" value="<?= htmlspecialchars($order['user_name']) ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Select Products</label>
                                            <?php foreach ($products as $product): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="products[]" id="product_<?= $product['id'] ?>" value="<?= $product['id'] ?>" <?= in_array($product['id'], $selectedProducts) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="product_<?= $product['id'] ?>">
                                                        <?= htmlspecialchars($product['title']) ?> ($<?= $product['discounted_price'] ?>)
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="payment_method" class="form-label">Payment Method</label>
                                            <select class="form-control" name="payment_method">
                                                <?php foreach (['Cash', 'Card', 'UPI'] as $method): ?>
                                                    <option value="<?= $method ?>" <?= $order['payment_method'] === $method ? 'selected' : '' ?>><?= $method ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="payment_status" class="form-label">Payment Status</label>
                                            <select class="form-select" name="payment_status">
                                                <?php foreach (['Unpaid', 'Paid', 'Refunded'] as $status): ?>
                                                    <option value="<?= $status ?>" <?= $order['payment_status'] === $status ? 'selected' : '' ?>><?= $status ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="order_status" class="form-label">Order Status</label>
                                            <select class="form-select" name="order_status">
                                                <?php foreach (['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'] as $status): ?>
                                                    <option value="<?= $status ?>" <?= $order['order_status'] === $status ? 'selected' : '' ?>><?= $status ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <div id="formMessage" style="margin-top: 10px;"></div>
                                    </form>
                                <?php } else { ?>
                                    <div class="alert alert-warning">No orders found.</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/sidebarmenu.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="assets/js/auth.js"></script>
<script src="assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>