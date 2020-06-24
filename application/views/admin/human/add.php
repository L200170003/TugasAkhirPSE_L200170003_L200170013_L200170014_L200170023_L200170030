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
            <h1>Add Human</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/human/table') ?>">Human</a></li>
              <li class="breadcrumb-item active">Add</li>
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
              <form action="<?php echo site_url('admin/human/add') ?>" class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_idpegawai_" class="col-sm-3 col-form-label" style="text-align: right;">Id Pegawai</label>
                    <div class="col-sm-6">
                      <input type="text" name="_idpegawai_" class="form-control" id="_idpegawai_" placeholder="Id Pegawai" value="<?php echo set_value('_idpegawai_'); ?>" required="required" minlength="1" maxlength="15">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_namapegawai_" class="col-sm-3 col-form-label" style="text-align: right;">Nama Pegawai</label>
                    <div class="col-sm-6">
                      <input type="text" name="_namapegawai_" class="form-control" id="_namapegawai_" placeholder="Nama Pegawai" value="<?php echo set_value('_namapegawai_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_alamatpegawai_" class="col-sm-3 col-form-label" style="text-align: right;">Alamat Pegawai</label>
                    <div class="col-sm-6">
                      <input type="text" name="_alamatpegawai_" class="form-control" id="_alamatpegawai_" placeholder="Alamat Pegawai" value="<?php echo set_value('_alamatpegawai_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_telppegawai_" class="col-sm-3 col-form-label" style="text-align: right;">Telepon Pegawai</label>
                    <div class="col-sm-6">
                      <input type="text" name="_telppegawai_" class="form-control" id="_telppegawai_" placeholder="Telepon Pegawai" value="<?php echo set_value('_telppegawai_'); ?>" required="required" minlength="1" maxlength="15">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_divisipegawai_" class="col-sm-3 col-form-label" style="text-align: right;">Divisi Pegawai</label>
                    <div class="col-sm-6">
                      <input type="text" name="_divisipegawai_" class="form-control" id="_divisipegawai_" placeholder="Divisi Pegawai" value="<?php echo set_value('_divisipegawai_'); ?>" required="required" minlength="2" maxlength="45">
                    </div>
                  </div>
    
                  <div class="form-group row">
                    <label for="_jabatanpegawai_" class="col-sm-3 col-form-label" style="text-align: right;">Jabatan Pegawai</label>
                    <div class="col-sm-6">
                      <input type="text" name="_jabatanpegawai_" class="form-control" id="_jabatanpegawai_" placeholder="Jabatan Pegawai" value="<?php echo set_value('_jabatanpegawai_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_jamkerja_" class="col-sm-3 col-form-label" style="text-align: right;">Jam Kerja</label>
                    <div class="col-sm-6">
                      <input type="text" name="_jamkerja_" class="form-control" id="_jamkerja_" placeholder="Jam Kerja" value="<?php echo set_value('_jamkerja_'); ?>" required="required" minlength="1" maxlength="15">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                      <button type="button" class="btn btn-warning" onclick="goBack()">Cancel</button>
                      <button type="reset" class="btn btn-info" id="_reset_">Reset</button>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
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
          window.location.replace("<?php echo site_url('admin/human/table') ?>");
        }
      });
    }

  });
</script>
</body>
</html>
