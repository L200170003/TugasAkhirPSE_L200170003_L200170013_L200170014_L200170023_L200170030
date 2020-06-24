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
        background-image: url('<?php echo base_url("assets/images/background/bg4.jpg")?>');
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
      <div class="card-body login-card-body">
        <p class="login-box-msg">Template Multi Level Login</p>

        <form action="<?php echo site_url('admin/dashboard') ?>" method="post">
          <div class="row" style="margin-bottom:10px;">
            <div class="col-12">
              <a href="https://www.instagram.com/rid1bdbx/" target="_blank">
                <button type="button" class="btn btn-primary btn-block">
                  <i class="fab fa-instagram"></i>
                  <span class="border-left" style="margin-right: 5px; margin-left: 5px;"></span>
                  CONTACT ME
                </button>
              </a>
            </div>
          </div>
          <div class="row" style="margin-bottom:10px;">
            <div class="col-12">
              <a href="https://github.com/L200160026/Base-Codeigniter" target="_blank">
                <button type="button" class="btn btn-primary btn-block">
                  <i class="fab fa-github-alt"></i>
                  <span class="border-left" style="margin-right: 5px; margin-left: 5px;"></span>
                  GITHUB
                </button>
              </a>
            </div>
          </div>
          <div class="row" style="margin-bottom:10px;">
            <div class="col-12">
              <a href="<?php echo site_url('admin/dashboard') ?>">
                <button type="button" class="btn btn-primary btn-block">
                  <i class="fas fa-user-cog"></i>
                  <span class="border-left" style="margin-right: 5px; margin-left: 5px;"></span>
                  Go To Admin
                </button>
              </a>
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
    particlesJS.load('particles-js', '<?php echo base_url("assets/particles/config2.json") ?>', function() {
      console.log('callback - particles.js config loaded');
    });
  </script>

</body>
</html>
