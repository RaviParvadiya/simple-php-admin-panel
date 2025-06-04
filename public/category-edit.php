<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

checkUserSession();

?>

<?php
require_once DATABASE_PATH . '/connection.php';
require_once MODELS_PATH . '/CategoryModel.php';

if (!isset($_GET['id'])) {
    exit;
}

$category_id = $_GET['id'];
$errorMessage = null;
$category = [];

try {
    $conn = getDBConnection();
    $category = getCategoryById($conn, $category_id);
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
                        <h5 class="card-title fw-semibold mb-4">Edit Category</h5>
                        <div class="card">
                            <div class="card-body">
                                <form id="editCategoryForm" action="#" method="post">
                                    <div class="mb-3">
                                        <label for="category_name" class="form-label">Category name</label>
                                        <input type="text" class="form-control" name="category_name" id="category_name" value="<?= htmlspecialchars($category['name'] ?? '') ?>">
                                    </div>
                                    <!-- Hidden input to send category ID -->
                                    <input type="hidden" name="category_id" value="<?= htmlspecialchars($category['id'] ?? '') ?>">
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