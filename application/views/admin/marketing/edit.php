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
            <h1>Edit Marketing</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/marketing/table') ?>">Marketing</a></li>
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
              <form action="<?php echo site_url('admin/marketing/edit/'.$encrypt_id) ?>" class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_kodemarketing_" class="col-sm-3 col-form-label" style="text-align: right;">Kode Marketing</label>
                    <div class="col-sm-6">
                      <input type="text" name="_kodemarketing_" class="form-control" id="_kodemarketing_" placeholder="Kode Marketing" value="<?php if (set_value('_kodemarketing_') != null) { echo set_value('_kodemarketing_'); } else { echo $marketing['kode_marketing']; } ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_namamarketing_" class="col-sm-3 col-form-label" style="text-align: right;">Nama Marketing</label>
                    <div class="col-sm-6">
                      <input type="text" name="_namamarketing_" class="form-control" id="_namamarketing_" placeholder="Nama Marketing" value="<?php if (set_value('_namamarketing_') != null) { echo set_value('_namamarketing_'); } else { echo $marketing['nama_marketing']; } ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_targetmarketing_" class="col-sm-3 col-form-label" style="text-align: right;">Target Marketing</label>
                    <div class="col-sm-6">
                      <input type="text" name="_targetmarketing_" class="form-control" id="_targetmarketing_" placeholder="Target Marketing" value="<?php if (set_value('_targetmarketing_') != null) { echo set_value('_targetmarketing_'); } else { echo $marketing['target_marketing']; } ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_biayamarketing_" class="col-sm-3 col-form-label" style="text-align: right;">Biaya Marketing</label>
                    <div class="col-sm-6">
                      <input type="number" name="_biayamarketing_" class="form-control" id="_biayamarketing_" placeholder="Biaya Marketing" value="<?php if (set_value('_biayamarketing_') != null) { echo set_value('_biayamarketing_'); } else { echo $marketing['biaya_marketing']; } ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_kodeproduksi_" class="col-sm-3 col-form-label" style="text-align: right;">Kode Produksi</label>
                      <div class="col-sm-6">
                        <select class="form-control" id="_kodeproduksi_" name="_kodeproduksi_" required="required">
                          <option selected disabled hidden>--Kode Produksi--</option>
                          <?php
                            foreach ($production as $key => $value) {
                          ?>
                            <option value="<?php echo $value['kode_produksi'] ?>" <?php if (set_select('_kodeproduksi_', $value['kode_produksi'] ) != null) { echo set_select('_kodeproduksi_', $value['kode_produksi'] ); } elseif ($marketing['production_kode_produksi'] == $value['kode_produksi'] ) { echo 'selected'; } ?>> <?php echo $value['kode_produksi'] ?></option>
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
          window.location.replace("<?php echo site_url('admin/marketing/table') ?>");
        }
      });
    }

  });
</script>
</body>
</html>
