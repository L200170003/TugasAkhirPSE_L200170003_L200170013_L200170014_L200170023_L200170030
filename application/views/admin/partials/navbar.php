  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- User Account: style can be found in dropdown.less -->
      <li class="nav-item dropdown user user-menu border-left">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="<?php echo base_url('uploads/account/'.$session['image'])?>" class="user-image" alt="User Image">
          <span> <?php echo $session["name"] ?></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user" style="margin-bottom: 0;">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-transparent">
                <h3 class="widget-user-username"><?php echo $session["name"] ?></h3>
                <h5 class="widget-user-desc">My Profile</h5>
              </div>

              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="<?php echo base_url('uploads/account/'.$session['image'])?>" alt="User Avatar">
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right" style="text-align: center;">
                    <a href="<?php echo site_url('admin/account/profile') ?>">
                      <button type="button" class="btn btn-info"><i class="fas fa-user"></i> Profile</button>
                    </a>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6" style="text-align: center;">
                    <a href="<?php echo site_url('admin/dashboard/logout') ?>">
                      <button type="button" class="btn btn-info"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </a>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->