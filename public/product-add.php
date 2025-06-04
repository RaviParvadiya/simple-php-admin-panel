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
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add Product</h5>
            <div class="card">
              <div class="card-body">
                <form id="addProductForm" action="/simple/handlers/product/add.php" method="post" enctype="multipart/form-data">
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
                    <input type="number" class="form-control" name="original_price" id="original_price" step="1">
                  </div>
                  <div class="mb-3">
                    <label for="discounted_price" class="form-label">Discounted Price</label>
                    <input type="number" class="form-control" name="discounted_price" id="discounted_price" step="1">
                  </div>
                  <div class="mb-3">
                    <label for="category_id" class="form-label">Select Category</label>
                    <select class="form-select" name="category_id" id="category_id" required>
                      <option value="">-- Choose a Category --</option>
                      <?php if (count($categories) > 0):
                        foreach ($categories as $category) { ?>
                          <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                      <?php }
                      endif; ?>
                    </select>
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
</div>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/sidebarmenu.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="assets/js/auth.js"></script>
<script src="assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>