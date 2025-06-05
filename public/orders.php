<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

checkUserSession();

?>

<?php

require_once DATABASE_PATH . '/connection.php';
require_once MODELS_PATH . '/OrderModel.php';

$errorMessage = null;
$orders = [];

try {
    $conn = getDBConnection();
    $orders = getAllOrders($conn);
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
            <?php if ($errorMessage) { ?>
                <div class="alert alert-danger"><?= $errorMessage ?></div>
            <?php } ?>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">All Orders</h4>

                        <?php if (count($orders) > 0) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Order #</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Order Status</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order) { ?>
                                            <tr>
                                                <td><?= htmlspecialchars($order['id']) ?></td>
                                                <td><?= htmlspecialchars($order['user_name'] ?? 'Unknown') ?></td>
                                                <td><?= Date('Y-m-d', strtotime(htmlspecialchars($order['order_date']))) ?></td>
                                                <td><?= htmlspecialchars($order['payment_method']) ?></td>
                                                <td>
                                                    <span class="badge bg-info text-dark"><?= htmlspecialchars($order['order_status']) ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success"><?= htmlspecialchars($order['payment_status']) ?></span>
                                                </td>
                                                <td>
                                                    <a href="order-view.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-secondary">View</a>
                                                    <a href="order-edit.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <button class="btn btn-sm btn-danger delete-order" data-id="<?= $order['id'] ?>">Delete</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/sidebarmenu.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="assets/js/auth.js"></script>
<script src="assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>