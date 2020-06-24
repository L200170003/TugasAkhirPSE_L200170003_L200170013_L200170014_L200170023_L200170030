<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view("admin/partials/head.php") ?>
</head>
<body class="hold-transition sidebar-mini pace-primary">
<!-- Site wrapper -->
<div class="wrapper">
  <?php $this->load->view("admin/partials/navbar.php") ?>

  <?php $this->load->view("admin/partials/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/account/table') ?>">Account</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Input</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo site_url('admin/account/edit/'.$encrypt_id)?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_name_" class="col-sm-3 col-form-label" style="text-align: right;">Name</label>
                    <div class="col-sm-6">
                      <input type="text" name="_name_" class="form-control" id="_name_" placeholder="Name" value="<?php if (set_value('_name_') != null) { echo set_value('_name_'); } else { echo $account['account_name']; } ?>" required="required" minlength="4" maxlength="20">
                    </div>
                  </div>

                  <?php if($session["level"] == "root") { ?>
                  <div class="form-group row">
                    <label for="_username_" class="col-sm-3 col-form-label" style="text-align: right;">Username</label>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-md-11 col-sm-11">
                          <input type="text" name="_username_" class="form-control" id="_username_" placeholder="Username" value="<?php if (set_value('_username_') != null) { echo set_value('_username_'); } else { echo $account['account_username']; } ?>" disabled required="required" minlength="4" maxlength="12">
                        </div>
                        <div class="col-md-1 col-sm-1" style="text-align: center; padding-top: 1.5%;">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="_checkusername_">
                            <label for="_checkusername_">
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <div class="form-group row">
                    <label for="_password_" class="col-sm-3 col-form-label" style="text-align: right;">Password</label>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-md-11 col-sm-11">
                          <input type="password" name="_password_" class="form-control" id="_password_" placeholder="Password" value="<?php echo set_value('_password_'); ?>" disabled required="required" minlength="4" maxlength="20">
                        </div>
                        <div class="col-md-1 col-sm-1" style="text-align: center; padding-top: 1.5%;">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="_checkpassword_">
                            <label for="_checkpassword_">
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_passconf_" class="col-sm-3 col-form-label" style="text-align: right;">Confirm Password</label>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-md-11 col-sm-11">
                          <input type="password" name="_passconf_" class="form-control" id="_passconf_" placeholder="Confirm Password" value="<?php echo set_value('_passconf_'); ?>" disabled required="required" minlength="4" maxlength="20">
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <?php if($session["level"] == "root") { ?>
                  <div class="form-group row">
                    <label for="_level_" class="col-sm-3 col-form-label" style="text-align: right;">Level</label>
                    <div class="col-sm-6">
                      <select name="_level_" id="_level_" class="form-control" required="required">
                        <option selected disabled hidden>- Choose Level -</option>
                        <option value="root" <?php if (set_select('_level_', 'root') != null) { echo set_select('_level_', 'root'); } elseif ($account['account_level'] == 'root') { echo 'selected'; } ?> >Root</option>
                        <option value="admin" <?php if (set_select('_level_', 'admin') != null) { echo set_select('_level_', 'admin'); } elseif ($account['account_level'] == 'admin') { echo 'selected'; } ?> >Admin</option>
                        <option value="user" <?php if (set_select('_level_', 'user') != null) { echo set_select('_level_', 'user'); } elseif ($account['account_level'] == 'user') { echo 'selected'; } ?> >User</option>
                      </select>
                    </div>
                  </div>
                  <?php } ?>

                  <div class="form-group row">
                    <label for="_image_" class="col-sm-3 col-form-label" style="text-align: right;">Image</label>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-3">
                          <img src="<?php echo base_url('uploads/account/'.$account['account_image'])?>" id="img-preview" alt="Profile Image" class="img-thumbnail">
                          <?php if ($account['account_image'] != "default.png") { ?>
                            <button type="button" id="img-delete" data-id="<?php echo $encrypt_id; ?>" class="btn btn-default btn-xs btn-block" >Delete Image</button>
                          <?php } ?>
                        </div>
                        <div class="col-sm-9">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="_image_" name="_image_" accept="image/*">
                            <input type="hidden" id="_checkfile_" name="_checkfile_" value="_image_">
                            <label class="custom-file-label" for="customFile" id="filename" style="overflow: hidden;">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="col-md-6 col-sm-6 offset-md-3">
                    <button type="button" class="btn btn-warning" onclick="goBack()">Cancel</button>
                    <button type="reset" class="btn btn-info" id="_reset_">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view("admin/partials/footer.php") ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php $this->load->view("admin/partials/javascript.php") ?>
<script>
  function goBack() {
    window.history.back();
  }

  function img_pathUrl(input){
    $('#img-preview')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
  }

  $(document).ready(function(){
    // ===== Enable or disable input username =====
    $("#_checkusername_").on( "change", function(){
      if ($(this).is(':checked')) {
        $( "input[name='_username_']" ).prop( "disabled", false );
      } else {
        $( "input[name='_username_']" ).prop( "disabled", true );
      }
    });

    // ===== Enable or disable input password & confirm password =====
    $("#_checkpassword_").on( "change", function(){
      if ($(this).is(':checked')) {
        $( "input[name='_password_']" ).prop( "disabled", false );
        $( "input[name='_passconf_']" ).prop( "disabled", false );
      } else {
        $( "input[name='_password_']" ).prop( "disabled", true );
        $( "input[name='_passconf_']" ).prop( "disabled", true );
      }
    });

    // ===== Delete Image OnClick =====
    $("#img-delete").on("click", function(){
      var id = $(this).data("id");
      console.log(id);
      $.ajax({
        type: "POST",
        data: {id: id},
        url: "<?php echo site_url('admin/API/account/delete-img')?>",
        dataType: "JSON",
        success: function (data) {
          if (data.status == "success") {
            $("#img-preview").attr("src","<?php echo base_url('uploads/account/default.png')?>");
            $("#img-delete").remove();
            Swal.fire({
              icon: 'success',
              title: 'Success...',
              text: data.message
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: data.message
            });
          }
        }
      });
    });

    // ===== If you upload an image =====
    $("#_image_").on("change", function() {
      var files = $(this).get(0).files;
      var eks = (files[0].name).split('.')[1];

      // Check extension type
      if (files[0].type != "image/jpeg" && files[0].type != "image/png" && files[0].type != "image/jpg") {
        $("#filename").text("");
        $("#_image_").val("");
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          html: 'The filetype you are attempting to upload is not allowed'
        });
      } else {
        $("#filename").text(files[0].name);
        img_pathUrl($(this).get(0));
      }
    });

    // ===== Reset button is clicked =====
    $("#_reset_").on("click", function(){
      $("#filename").text("Choose file");
      $("#img-preview").attr("src","<?php echo base_url('uploads/account/default.png')?>");
    });

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
      });
    } else if(notif.status == "success" && notif.message != ""){
      Swal.fire({
        icon: 'success',
        title: 'Success...',
        html: notif.message,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Check Data',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.value) {
          window.location.replace("<?php echo site_url('admin/account/table') ?>");
        }
      });
    }

  });
</script>
</body>
</html>
