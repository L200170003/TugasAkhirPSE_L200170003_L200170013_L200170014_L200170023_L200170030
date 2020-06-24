<!-- 
===============================================================
BaseCodeigniter
Author : Ridwan Renaldi (RID1)
Date Created : 10/05/2020
License : freely distributed/modified with credit attribution.
Contact Me : @rid1bdbx (instagram)
=============================================================== 
-->
<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view("admin/partials/head.php") ?>
  <style>
    body,
    html {
        height: 100%
    }

    #particles-js canvas {
        display: block;
        vertical-align: bottom;
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
        opacity: 1;
        -webkit-transition: opacity .8s ease, -webkit-transform 1.4s ease;
        transition: opacity .8s ease, transform 1.4s ease
    }

    #particles-js {
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: -10;
        top: 0;
        left: 0;
        background-image: url('<?php echo base_url("assets/images/background/bg5.jpg")?>');
        background-repeat: no-repeat;
        background-size: cover;
    }

  </style>
</head>
<body class="hold-transition login-page pace-primary">
  <div id="particles-js"></div>
  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo site_url('admin/dashboard') ?>" style="color: #fff;"><b>Base</b>Codeigniter</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card card-widget widget-user" style="margin-bottom: 0;">
        <div class="widget-user-image" style="top:-160px; ">
          <img class="img-circle elevation-2" src="<?php echo base_url('assets/images/default.png')?>" alt="User Avatar">
        </div>
      </div>
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="<?php echo site_url('admin/dashboard') ?>" method="post">

          <div class="input-group mb-3">
            <input type="text" name="_username_" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" name="_password_" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
            </div>
          </div>

        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <?php $this->load->view("admin/partials/javascript.php") ?>
  <!-- Particle JS -->
  <script src="<?php echo base_url('assets/particles/particles.js')?>"></script>
  <!-- <script src="<?php //echo base_url('assets/particles/demo/js/app.js')?>"></script>
  <script src="<?php //echo base_url('assets/particles/demo/js/lib/stats.js')?>"></script> -->
  <script>
    particlesJS.load('particles-js', '<?php echo base_url("assets/particles/config3.json") ?>', function() {
      console.log('callback - particles.js config loaded');
    });

    $(document).ready(function(){
      // ===== Notification alert =====
      var notif = {
        status:"<?php if(isset($notif["status"])) { echo $notif["status"]; } ?>", 
        message:"<?php if(isset($notif["message"])) { echo $notif["message"]; } ?>"
      };

      if (notif.status == "error" && notif.message != "") {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          html: notif.message
        })
      } else if(notif.status == "success" && notif.message != ""){
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          html: notif.message
        })
      }

    });
  </script>

</body>
</html>
