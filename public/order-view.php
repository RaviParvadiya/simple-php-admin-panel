<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

checkUserSession();

require_once DATABASE_PATH . '/connection.php';
require_once MODELS_PATH . '/OrderModel.php';

if (!isset($_GET['id'])) {
    echo "Accessing invalid data!";
    header('Location: orders.php');
    exit;
}

$errorMessage = null;
$orderDetails = [];

try {
    $conn = getDBConnection();
    $orderId = htmlspecialchars(trim($_GET['id']));
    $orderDetails = getOrderDetails($conn, $orderId); // Make sure this returns product + order summary fields
} catch (PDOException $e) {
    $errorMessage = "<div class='alert alert-danger'>Sorry, we're experiencing technical difficulties. Please try again later.</div>";
}

?>

<?php
function getStatusBadgeClass($status)
{
    $status = strtolower(trim($status));

    switch ($status) {
        case 'completed':
        case 'delivered':
        case 'paid':
            return 'bg-success';
        case 'pending':
        case 'processing':
            return 'bg-warning text-dark';
        case 'cancelled':
        case 'failed':
        case 'refunded':
            return 'bg-danger';
        default:
            return 'bg-secondary';
    }
}
?>

<?php include INCLUDES_PATH . '/partials/header.php'; ?>

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    <?php include INCLUDES_PATH . '/partials/sidebar.php' ?>
    <!-- Sidebar End -->

    <div class="body-wrapper">
        <!-- Topbar -->
        <?php include INCLUDES_PATH . '/partials/topbar.php' ?>

        <div class="container-fluid">
            <?php if ($errorMessage) {
                echo $errorMessage;
            } elseif (count($orderDetails) > 0) {
                $order = $orderDetails[0]; // use first row for summary info
            ?>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h4>Order #<?= htmlspecialchars($order['id']) ?></h4>
                        <p><strong>Customer:</strong> <?= htmlspecialchars($order['user_name']) ?></p>
                        <p><strong>Order Date:</strong> <?= date('Y-m-d', strtotime($order['order_date'])) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                        <p><strong>Payment Status:</strong>
                            <span class="badge <?= getStatusBadgeClass($order['payment_status']) ?>"><?= htmlspecialchars($order['payment_status']) ?></span>
                        </p>
                        <p><strong>Order Status:</strong>
                            <span class="badge <?= getStatusBadgeClass($order['order_status']) ?>"><?= htmlspecialchars($order['order_status']) ?></span>
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Items</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $grandTotal = $order['total_amount'];
                                    foreach ($orderDetails as $item) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['product_title']) ?></td>
                                            <td>
                                                <img src="assets/images/products/<?= htmlspecialchars($item['product_image']) ?>"
                                                    alt="Product Image" class="img-thumbnail" width="120">
                                            </td>
                                            <td>$<?= $item['price'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>Grand Total</strong></td>
                                        <td><strong>$<?= number_format($grandTotal, 0) ?></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            <?php } else { ?>
                <div class="alert alert-warning">No order details found.</div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/sidebarmenu.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="assets/js/auth.js"></script>
<script src="assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>