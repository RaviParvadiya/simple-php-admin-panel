<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

checkUserSession();

?>

<?php

require_once DATABASE_PATH . '/connection.php';
require_once MODELS_PATH . '/CategoryModel.php';

$errorMessage = null;
$categories = [];

try {
    $conn = getDBConnection();
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
            <div class="row">
                <?php if ($errorMessage) { ?>
                    <div class="alert alert-danger"><?= $errorMessage ?></div>
                    <?php } elseif (count($categories) > 0) {
                    foreach ($categories as $category) { ?>
                        <div class="col-sm-6 col-xl-3 category-card" data-id="<?= $category['id'] ?>">
                            <div class="card p-3">
                                <h5><?= htmlspecialchars($category['name']) ?></h5>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="category-edit.php?id=<?= $category['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger delete-category" data-id="<?= $category['id'] ?>">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="alert alert-warning">No categories found.</div>
                <?php } ?>
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