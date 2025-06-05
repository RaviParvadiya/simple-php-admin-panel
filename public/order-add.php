<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

checkUserSession();

?>

<?php

require_once DATABASE_PATH . '/connection.php';
require_once MODELS_PATH . '/UserModel.php';
require_once MODELS_PATH . '/ProductModel.php';

$errorMessage = null;
$users = [];
$products = [];

try {
    $conn = getDBConnection();
    $users = getAllUsers($conn);
    $products = getAllProducts($conn);
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
                        <h5 class="card-title fw-semibold mb-4">Add Order</h5>
                        <div class="card">
                            <div class="card-body">
                                <form id="addOrderForm" action="#" method="post">
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">Select User</label>
                                        <select class="form-select" name="user_id" id="user_id" required>
                                            <?php if (count($users) > 0):
                                                foreach ($users as $user) { ?>
                                                    <option value="<?= $user['id'] ?>"><?= ucwords(htmlspecialchars($user['name'])) ?></option>
                                            <?php }
                                            endif; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Products</label>
                                        <?php if (count($products) > 0): ?>
                                            <?php foreach ($products as $product): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="products[]" id="product_<?= $product['id'] ?>" value="<?= $product['id'] ?>">
                                                    <label class="form-check-label" for="product_<?= $product['id'] ?>">
                                                        <?= htmlspecialchars($product['title']) ?> ($<?= $product['discounted_price'] ?>)
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p>No products found.</p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">Payment Method</label>
                                        <select class="form-control" name="payment_method">
                                            <option value="Cash">Cash</option>
                                            <option value="Card">Card</option>
                                            <option value="UPI">UPI</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label">Payment Status</label>
                                        <select class="form-control" name="payment_status">
                                            <option value="Unpaid">Unpaid</option>
                                            <option value="Paid">Paid</option>
                                            <option value="Refunded">Refunded</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="order_status" class="form-label">Order Status</label>
                                        <select class="form-control" name="order_status">
                                            <option value="Pending">Pending</option>
                                            <option value="Processing">Processing</option>
                                            <option value="Shipped">Shipped</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <div id="formMessage" style="margin-top: 10px;"></div>
                                </form>
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