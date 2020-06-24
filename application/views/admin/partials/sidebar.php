  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url('admin/dashboard') ?>" class="brand-link">
      <img src="<?php echo base_url('assets/adminlte/dist/img/AdminLTELogo.png')?>"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><small>Admin </small><strong>Control Panel</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('uploads/account/'.$session['image'])?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $session["name"] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="<?php echo site_url('admin/dashboard') ?>" class="nav-link <?php if($sidebar=='dashboard') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <?php if($session["level"]=="root"){ ?>
          <li class="nav-item has-treeview <?php if($sidebar=='account-table' || $sidebar=='account-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='account-table' || $sidebar=='account-add') { echo 'active'; } ?>">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Account
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/account/table') ?>" class="nav-link <?php if($sidebar=='account-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/account/add') ?>" class="nav-link <?php if($sidebar=='account-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <li class="nav-item has-treeview <?php if($sidebar=='inventory-table' || $sidebar=='inventory-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='inventory-table' || $sidebar=='inventory-add') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Inventory Control
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/inventory/table') ?>" class="nav-link <?php if($sidebar=='inventory-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/inventory/add') ?>" class="nav-link <?php if($sidebar=='inventory-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview <?php if($sidebar=='purchasing-table' || $sidebar=='purchasing-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='purchasing-table' || $sidebar=='purchasing-add') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Purchasing
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/purchasing/table') ?>" class="nav-link <?php if($sidebar=='purchasing-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/purchasing/add') ?>" class="nav-link <?php if($sidebar=='purchasing-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

          
          <li class="nav-item has-treeview <?php if($sidebar=='production-table' || $sidebar=='production-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='production-table' || $sidebar=='production-add') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-cube"></i>
              <p>
                Production
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/production/table') ?>" class="nav-link <?php if($sidebar=='production-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/production/add') ?>" class="nav-link <?php if($sidebar=='production-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php if($sidebar=='accounting-table' || $sidebar=='accounting-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='accounting-table' || $sidebar=='accounting-add') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-balance-scale"></i>
              <p>
                Accounting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/accounting/table') ?>" class="nav-link <?php if($sidebar=='accounting-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/accounting/add') ?>" class="nav-link <?php if($sidebar=='accounting-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Document -->

          <li class="nav-item has-treeview <?php if($sidebar=='documentmanagement-table' || $sidebar=='document_management-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='documentmanagement-table' || $sidebar=='document_management-add') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-envelope-open"></i>
              <p>
                Document Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/documentmanagement/table') ?>" class="nav-link <?php if($sidebar=='documentmanagement-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/documentmanagement/add') ?>" class="nav-link <?php if($sidebar=='documentmanagement-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

                    <!-- Marketing -->

          <li class="nav-item has-treeview <?php if($sidebar=='marketing-table' || $sidebar=='marketing-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='marketing-table' || $sidebar=='marketing-add') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Marketing
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/marketing/table') ?>" class="nav-link <?php if($sidebar=='marketing-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/marketing/add') ?>" class="nav-link <?php if($sidebar=='marketing-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>


                            <!-- SALES -->

          <li class="nav-item has-treeview <?php if($sidebar=='sales-table' || $sidebar=='sales-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='sales-table' || $sidebar=='sales-add') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                Sales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/sales/table') ?>" class="nav-link <?php if($sidebar=='sales-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/sales/add') ?>" class="nav-link <?php if($sidebar=='sales-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>


                            <!-- PAYROLL -->

          <li class="nav-item has-treeview <?php if($sidebar=='payroll-table' || $sidebar=='payroll-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='payroll-table' || $sidebar=='payroll-add') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Payroll
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/payroll/table') ?>" class="nav-link <?php if($sidebar=='payroll-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/payroll/add') ?>" class="nav-link <?php if($sidebar=='payroll-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>

                                      <!-- Human -->

          <li class="nav-item has-treeview <?php if($sidebar=='human-table' || $sidebar=='human-add') { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($sidebar=='human-table' || $sidebar=='human-add') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Human
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/human/table') ?>" class="nav-link <?php if($sidebar=='human-table') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Table</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/human/add') ?>" class="nav-link <?php if($sidebar=='human-add') { echo 'active'; } ?>">
                  <i class="fa fa-caret-right nav-icon" style="margin-left: 25px;"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>