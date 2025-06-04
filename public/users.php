<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

checkUserSession();

?>

<?php

require_once DATABASE_PATH . '/connection.php';
require_once MODELS_PATH . '/UserModel.php';

$errorMessage = null;
$users = [];

try {
    $conn = getDBConnection();
    $users = getAllUsers($conn);
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
                <?php if (count($users) > 0) {
                    foreach ($users as $user) { ?>
                        <div class="col-sm-6 col-xl-3 user-card" data-id="<?= $user['id'] ?>">
                            <div class="card p-3">
                                <h5><?= ucwords(htmlspecialchars($user['name'])) ?></h5>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="user-edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger delete-user" data-id="<?= $user['id'] ?>">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="alert alert-warning">No users found.</div>
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