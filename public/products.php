<?php

require_once '../includes/session.php';

checkUserSession();

?>

<?php
require_once '../database/connection.php';
require_once '../models/ProductModel.php';

$errorMessage = null;
$products = [];

try {
    $conn = getDBConnection();
    $products = getAllProducts($conn);
} catch (PDOException $e) {
    $errorMessage = "<div class='error'>Sorry, we're experiencing technical difficulties. Please try again later.</div>";
}

?>
<?php include '../includes/header.php'; ?>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include '../includes/sidebar.php' ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <?php include '../includes/topbar.php' ?>
        <!--  Header End -->
        <div class="container-fluid">
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger" role="alert">
                    <?= ($errorMessage) ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php if (!$errorMessage): ?>
                    <?php
                    if (count($products) > 0) {
                        foreach ($products as $product) { ?>
                            <div class="col-sm-6 col-xl-3 product-card" data-id="<?= $product['product_id'] ?>">
                                <div class="card overflow-hidden rounded-2">
                                    <div class="position-relative">
                                        <a href="javascript:void(0)"><img src="assets/images/products/<?= htmlspecialchars($product['product_image']) ?>" class="card-img-top rounded-0" alt="<?= htmlspecialchars($product['product_image']) ?>"></a>
                                        <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
                                    </div>
                                    <div class="card-body pt-3 p-4">
                                        <h6 class="fw-semibold fs-4"><?= htmlspecialchars($product['product_title']) ?></h6>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="fw-semibold fs-4 mb-0">$<?= $product['discounted_price'] ?> <span class="ms-2 fw-normal text-muted fs-3"><del>$<?= $product['original_price'] ?></del></span></h6>
                                            <ul class="list-unstyled d-flex align-items-center mb-0">
                                                <li><a href="edit_product.php?id=<?php echo $product['product_id'] ?>" class="me-1">Edit</a></li>
                                                <li><a href="javascript:void(0)" class="me-1 text-danger delete-product" data-id="<?php echo $product['product_id'] ?>">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else { ?>
                        <div class="alert alert-warning" role="alert">
                            No products found.
                        </div>
                    <?php  } ?>
                <?php endif; ?>
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