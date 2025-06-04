<?php

require_once '../includes/session.php';

startSession();

if (isset($_SESSION['admin_id'])) {
  header("Location: index.php");
  exit;
}

?>

<?php include INCLUDES_PATH . '/partials/header.php'; ?>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
  data-sidebar-position="fixed" data-header-position="fixed">
  <div
    class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
      <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xxl-3">
          <div class="card mb-0">
            <div class="card-body">
              <a href="./index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                <img src="assets/images/logos/dark-logo.svg" width="180" alt="">
              </a>
              <p class="text-center">Your Social Campaigns</p>
              <form id="registerForm" method="post" action="#">
                <div class="mb-3">
                  <label for="exampleInputtext1" class="form-label">Name</label>
                  <input type="text" name="username" class="form-control" id="exampleInputtext1" aria-describedby="textHelp">
                  <div id="usernameError" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email Address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailError" class="form-text text-danger"></div>
                </div>
                <div class="mb-4">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                  <div id="passwordError" class="form-text text-danger"></div>
                </div>
                <a href="#" id="signupBtn" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</a>
                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                  <a class="text-primary fw-bold ms-2" href="./login.php">Sign In</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include INCLUDES_PATH . '/partials/footer.php'; ?>