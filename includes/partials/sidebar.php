  <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
              <a href="./index.php" class="text-nowrap logo-img">
                  <img src="assets/images/logos/dark-logo.svg" width="180" alt="" />
              </a>
              <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                  <i class="ti ti-x fs-8"></i>
              </div>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
              <ul id="sidebarnav">
                  <li class="sidebar-item">
                      <a class="sidebar-link" href="<?php echo BASE_URL ?>index.php" aria-expanded="false">
                          <span>
                              <i class="ti ti-layout-dashboard"></i>
                          </span>
                          <span class="hide-menu">Dashboard</span>
                      </a>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                          <span>
                              <i class="ti ti-package"></i>
                          </span>
                          <span class="hide-menu">Products</span>
                      </a>
                      <ul aria-expanded="false" class="collapse first-level">
                          <li class="sidebar-item">
                              <a class="sidebar-link" href="<?php echo BASE_URL ?>products.php" aria-expanded="false">
                                  <span>
                                      <i class="ti ti-list"></i>
                                  </span>
                                  <span class="hide-menu">All Products</span>
                              </a>
                          </li>
                          <li class="sidebar-item">
                              <a class="sidebar-link" href="<?php echo BASE_URL ?>product-add.php" aria-expanded="false">
                                  <span>
                                      <i class="ti ti-plus"></i>
                                  </span>
                                  <span class="hide-menu">Add Product</span>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                          <span>
                              <i class="ti ti-tags"></i>
                          </span>
                          <span class="hide-menu">Categories</span>
                      </a>
                      <ul aria-expanded="false" class="collapse first-level">
                          <li class="sidebar-item">
                              <a class="sidebar-link" href="<?php echo BASE_URL ?>categories.php" aria-expanded="false">
                                  <span>
                                      <i class="ti ti-list-details"></i>
                                  </span>
                                  <span class="hide-menu">All Categories</span>
                              </a>
                          </li>
                          <li class="sidebar-item">
                              <a class="sidebar-link" href="<?php echo BASE_URL ?>category-add.php" aria-expanded="false">
                                  <span>
                                      <i class="ti ti-folder-plus"></i>
                                  </span>
                                  <span class="hide-menu">Add Category</span>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                          <span>
                              <i class="ti ti-users"></i>
                          </span>
                          <span class="hide-menu">Users</span>
                      </a>
                      <ul aria-expanded="false" class="collapse first-level">
                          <li class="sidebar-item">
                              <a class="sidebar-link" href="<?php echo BASE_URL ?>users.php" aria-expanded="false">
                                  <span>
                                      <i class="ti ti-user-check"></i>
                                  </span>
                                  <span class="hide-menu">All Users</span>
                              </a>
                          </li>
                          <li class="sidebar-item">
                              <a class="sidebar-link" href="<?php echo BASE_URL ?>user-add.php" aria-expanded="false">
                                  <span>
                                      <i class="ti ti-user-plus"></i>
                                  </span>
                                  <span class="hide-menu">Add User</span>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                          <span>
                              <i class="ti ti-shopping-cart"></i>
                          </span>
                          <span class="hide-menu">Orders</span>
                      </a>
                      <ul aria-expanded="false" class="collapse first-level">
                          <li class="sidebar-item">
                              <a class="sidebar-link" href="<?php echo BASE_URL ?>orders.php" aria-expanded="false">
                                  <span>
                                      <i class="ti ti-receipt"></i>
                                  </span>
                                  <span class="hide-menu">All Orders</span>
                              </a>
                          </li>
                          <li class="sidebar-item">
                              <a class="sidebar-link" href="<?php echo BASE_URL ?>order-add.php" aria-expanded="false">
                                  <span>
                                      <i class="ti ti-shopping-cart-plus"></i>
                                  </span>
                                  <span class="hide-menu">Add Order</span>
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </nav>
          <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
  </aside>