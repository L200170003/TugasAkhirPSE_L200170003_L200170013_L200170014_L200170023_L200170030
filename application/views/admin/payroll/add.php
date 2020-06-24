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
            <h1>Add Payroll</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/payroll/table') ?>">Payroll</a></li>
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
              <form action="<?php echo site_url('admin/payroll/add') ?>" class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_kodepayroll_" class="col-sm-3 col-form-label" style="text-align: right;">Kode Payroll</label>
                    <div class="col-sm-6">
                      <input type="text" name="_kodepayroll_" class="form-control" id="_kodepayroll_" placeholder="Kode Payroll" value="<?php echo set_value('_kodepayroll'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_bulan_" class="col-sm-3 col-form-label" style="text-align: right;">Bulan</label>
                    <div class="col-sm-6">
                      <input type="text" name="_bulan_" class="form-control" id="_bulan_" placeholder="Bulan" value="<?php echo set_value('_bulan_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_tahun_" class="col-sm-3 col-form-label" style="text-align: right;">Tahun</label>
                    <div class="col-sm-6">
                      <input type="number" name="_tahun_" class="form-control" id="_tahun_" placeholder="Tahun" value="<?php echo set_value('_tahun_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_gajiperjam_" class="col-sm-3 col-form-label" style="text-align: right;">Gaji Perjam</label>
                    <div class="col-sm-6">
                      <input type="number" name="_gajiperjam_" class="form-control" id="_gajiperjam_" placeholder="Gaji Perjam" value="<?php echo set_value('_gajiperjam_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_idpegawai_" class="col-sm-3 col-form-label" style="text-align: right;">Nama Pegawai</label>
                    <div class="col-sm-6">
                      <select class="form-control" id="_idpegawai_" name="_idpegawai_">
                        <option selected disabled hidden>--Nama Pegawai--</option>
                        <?php
                          foreach ($human as $key => $value) {
                        ?>
                          <option value="<?php echo $value['id_pegawai'] ?>" <?php echo set_select('_idpegawai_', $value['id_pegawai'] ); ?>> <?php echo $value['nama_pegawai'] ?></option>
                        <?php
                          }
                        ?>
                      </select>
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
          window.location.replace("<?php echo site_url('admin/payroll/table') ?>");
        }
      });
    }

  });
</script>
</body>
</html>
