<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';


checkUserSession();

?>

<?php include INCLUDES_PATH . '/partials/header.php'; ?>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include '../includes/partials/sidebar.php' ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <?php include '../includes/partials/topbar.php' ?>
        <!--  Header End -->
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Add User</h5>
                        <div class="card">
                            <div class="card-body">
                                <form id="addUserForm" action="#" method="post">
                                    <div class="mb-3">
                                        <label for="user_name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter User Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="user_email" class="form-label">Email</label>
                                        <input type="text" class="form-control" name="user_email" id="user_email" placeholder="Enter User Email">
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