<?php

require_once dirname(__DIR__) . '/config/config.php';
require_once INCLUDES_PATH . '/session.php';

checkUserSession();

require_once DATABASE_PATH . '/connection.php';
require_once MODELS_PATH . '/ProductModel.php';
require_once MODELS_PATH . '/CategoryModel.php';
require_once MODELS_PATH . '/UserModel.php';
require_once MODELS_PATH . '/OrderModel.php';

$errorMessage = null;
$products = 0;
$categories = 0;
$users = 0;
$orders = 0;

try {
  $conn = getDBConnection();
  $products = count(getAllProducts($conn));
  $categories = count(getAllCategories($conn));
  $users = count(getAllUsers($conn));
  $orders = count(getAllOrders($conn));
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
      <!--  Row 1 -->
      <div class="row">
        <?php if ($errorMessage): ?>
          <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php elseif (!empty($products)): ?>
          <div class="col-lg-3">
            <div class="card overflow-hidden">
              <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Total Products</h5>
                <div class="row align-items-center">
                  <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo $products ?></h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-center">
                      <div id="breakup"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="alert alert-warning">Data not found.</div>
        <?php endif; ?>

        <?php if (!empty($categories)): ?>
          <div class="col-lg-3">
            <div class="card overflow-hidden">
              <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Total Categories</h5>
                <div class="row align-items-center">
                  <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo $categories ?></h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-center">
                      <div id="breakup"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="alert alert-warning">Data not found.</div>
        <?php endif; ?>

        <?php if (!empty($users)): ?>
          <div class="col-lg-3">
            <div class="card overflow-hidden">
              <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Total Users</h5>
                <div class="row align-items-center">
                  <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo $users ?></h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-center">
                      <div id="breakup"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="alert alert-warning">Data not found.</div>
        <?php endif; ?>

        <?php if (!empty($orders)): ?>
          <div class="col-lg-3">
            <div class="card overflow-hidden">
              <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Total Orders</h5>
                <div class="row align-items-center">
                  <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo $orders ?></h4>
                  </div>
                  <div class="col-4">
                    <div class="d-flex justify-content-center">
                      <div id="breakup"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="alert alert-warning">Data not found.</div>
        <?php endif; ?>
      </div>
      <div class="row">
        <div class="d-flex">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Id</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Assigned</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Name</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Priority</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Budget</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">1</h6>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                        <span class="fw-normal">Web Designer</span>
                      </td>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">Elite Admin</p>
                      </td>
                      <td class="border-bottom-0">
                        <div class="d-flex align-items-center gap-2">
                          <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                        </div>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0 fs-4">$3.9</h6>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">2</h6>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">Andrew McDownland</h6>
                        <span class="fw-normal">Project Manager</span>
                      </td>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">Real Homes WP Theme</p>
                      </td>
                      <td class="border-bottom-0">
                        <div class="d-flex align-items-center gap-2">
                          <span class="badge bg-secondary rounded-3 fw-semibold">Medium</span>
                        </div>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0 fs-4">$24.5k</h6>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">3</h6>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">Christopher Jamil</h6>
                        <span class="fw-normal">Project Manager</span>
                      </td>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">MedicalPro WP Theme</p>
                      </td>
                      <td class="border-bottom-0">
                        <div class="d-flex align-items-center gap-2">
                          <span class="badge bg-danger rounded-3 fw-semibold">High</span>
                        </div>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0 fs-4">$12.8k</h6>
                      </td>
                    </tr>
                    <tr>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">4</h6>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">Nirav Joshi</h6>
                        <span class="fw-normal">Frontend Engineer</span>
                      </td>
                      <td class="border-bottom-0">
                        <p class="mb-0 fw-normal">Hosting Press HTML</p>
                      </td>
                      <td class="border-bottom-0">
                        <div class="d-flex align-items-center gap-2">
                          <span class="badge bg-success rounded-3 fw-semibold">Critical</span>
                        </div>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0 fs-4">$2.4k</h6>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
<!-- <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script> -->
<script src="assets/libs/simplebar/dist/simplebar.js"></script>
<script src="assets/js/dashboard.js"></script>
</body>

</html>