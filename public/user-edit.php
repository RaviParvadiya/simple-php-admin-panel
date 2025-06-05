<?php

require_once '../includes/session.php';

checkUserSession();

?>

<?php
require_once '../database/connection.php';
require_once '../models/UserModel.php';

if (!isset($_GET['id'])) {
    exit;
}

$user_id = $_GET['id'];
$errorMessage = null;
$user = [];

try {
    $conn = getDBConnection();
    $user = getUserById($conn, $user_id);
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
                        <h5 class="card-title fw-semibold mb-4">Edit User</h5>
                        <div class="card">
                            <div class="card-body">
                                <?php if ($errorMessage) { ?>
                                    <div class="alert alert-danger"><?= $errorMessage ?></div>
                                <?php } elseif (!empty($user)) { ?>
                                    <form id="editUserForm" action="#" method="post">
                                        <div class="mb-3">
                                            <label for="user_name" class="form-label">name</label>
                                            <input type="text" class="form-control" name="user_name" id="user_name" value="<?= htmlspecialchars($user['name'] ?? '') ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="user_email" class="form-label">Email</label>
                                            <input type="text" class="form-control" name="user_email" id="user_email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                                        </div>
                                        <!-- Hidden input to send user ID -->
                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <div id="formMessage" style="margin-top: 10px;"></div>
                                    </form>
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