<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

checkUserSession();

?>

<?php
require_once DATABASE_PATH . '/connection.php';
require_once MODELS_PATH . '/ProductModel.php';
require_once MODELS_PATH . '/CategoryModel.php';

if (!isset($_GET['id'])) {
    exit;
}

$product_id = $_GET['id'];
$errorMessage = null;
$product = [];
$categories = [];

try {
    $conn = getDBConnection();
    $product = getProductById($conn, $product_id);
    $categories = getAllCategories($conn);
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
                        <h5 class="card-title fw-semibold mb-4">Edit Product</h5>
                        <div class="card">
                            <div class="card-body">
                                <form id="editProductForm" action="/simple/handlers/product/update.php" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="product_image" class="form-label">Upload Product Image</label>
                                        <input type="file" class="form-control" name="product_image" id="product_image" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="product_title" class="form-label">Product Title</label>
                                        <input type="text" class="form-control" name="product_title" id="product_title" value="<?= htmlspecialchars($product['title'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="original_price" class="form-label">Original Price</label>
                                        <input type="number" class="form-control" name="original_price" id="original_price" step="0.01" value="<?= htmlspecialchars($product['price'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="discounted_price" class="form-label">Discounted Price</label>
                                        <input type="number" class="form-control" name="discounted_price" id="discounted_price" step="0.01" value="<?= htmlspecialchars($product['discounted_price'] ?? '') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Select Category</label>
                                        <select class="form-select" name="category_id" id="category_id" required>
                                            <option value="" disabled <?= empty($product['category_id']) ? 'selected' : '' ?>>-- Choose a Category --</option>
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?= $category['id'] ?>" <?= ($product['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($category['name']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php if (!empty($product['image_url'])) { ?>
                                        <div class="mb-3">
                                            <label class="form-label d-block">Current Product Image</label>
                                            <img src="assets/images/products/<?php echo htmlspecialchars($product['image_url']) ?>" alt="<?php echo $product['title'] ?>" width="150" class="img-thumbnail">
                                        </div>
                                    <?php } ?>
                                    <!-- Hidden input to send product ID -->
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id'] ?? '') ?>">
                                    <button type="submit" class="btn btn-primary">Update</button>
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