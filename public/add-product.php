<?php

require_once '../includes/session.php';

checkUserSession();

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
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add Product</h5>
            <div class="card">
              <div class="card-body">
                <form id="addProductForm" action="/simple/handlers/add_product.php" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="product_image" class="form-label">Upload Product Image</label>
                    <input type="file" class="form-control" name="product_image" id="product_image" accept="image/*">
                  </div>
                  <div class="mb-3">
                    <label for="product_title" class="form-label">Product Title</label>
                    <input type="text" class="form-control" name="product_title" id="product_title">
                  </div>
                  <div class="mb-3">
                    <label for="original_price" class="form-label">Original Price</label>
                    <input type="number" class="form-control" name="original_price" id="original_price" step="0.01">
                  </div>
                  <div class="mb-3">
                    <label for="discounted_price" class="form-label">Discounted Price</label>
                    <input type="number" class="form-control" name="discounted_price" id="discounted_price" step="0.01">
                  </div>
                  <button type="submit" class="btn btn-primary">Add Product</button>
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