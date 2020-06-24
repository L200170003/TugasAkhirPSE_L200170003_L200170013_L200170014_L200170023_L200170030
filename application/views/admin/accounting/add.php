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
            <h1>Add Accounting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/accounting/table') ?>">Accounting</a></li>
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
              <form action="<?php echo site_url('admin/accounting/add') ?>" class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_idaccounting_" class="col-sm-3 col-form-label" style="text-align: right;">Id Accounting</label>
                    <div class="col-sm-6">
                      <input type="text" name="_idaccounting_" class="form-control" id="_idaccounting_" placeholder="Id Accounting" value="<?php echo set_value('_idaccounting_'); ?>" required="required" minlength="2" maxlength="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_tanggalaccounting_" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal</label>
                    <div class="col-sm-6">
                      <input type="date" name="_tanggalaccounting_" class="form-control" id="_tanggalaccounting_" placeholder="Tanggal" value="<?php echo set_value('_tanggalaccounting_'); ?>" required="required">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_keterangan_" class="col-sm-3 col-form-label" style="text-align: right;">Keterangan</label>
                    <div class="col-sm-6">
                      <input type="text" name="_keterangan_" class="form-control" id="_keterangan_" placeholder="Keterangan" value="<?php echo set_value('_keterangan_'); ?>" required="required" minlength="0" maxlength="45">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_kodemarketing_" class="col-sm-3 col-form-label" style="text-align: right;">Marketing</label>
                    <div class="col-sm-6">
                      <select class="form-control" id="_kodemarketing_" name="_kodemarketing_">
                        <option selected disabled hidden>--Kode Marketing--</option>
                        <?php
                          foreach ($marketing as $key => $value) {
                        ?>
                          <option value="<?php echo $value['kode_marketing'] ?>" <?php echo set_select('_kodemarketing_', $value['kode_marketing'] ); ?>> <?php echo $value['kode_marketing'] ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_kodepenjualan_" class="col-sm-3 col-form-label" style="text-align: right;">Sales</label>
                    <div class="col-sm-6">
                      <select class="form-control" id="_kodepenjualan_" name="_kodepenjualan_">
                        <option selected disabled hidden>--Sales--</option>
                        <?php
                          foreach ($sales as $key => $value) {
                        ?>
                          <option value="<?php echo $value['kode_penjualan'] ?>" <?php echo set_select('_kodepenjualan_', $value['kode_penjualan'] ); ?>> <?php echo $value['kode_penjualan'] ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_kodeproduksi_" class="col-sm-3 col-form-label" style="text-align: right;">Kode Produksi</label>
                    <div class="col-sm-6">
                      <select class="form-control" id="_kodeproduksi_" name="_kodeproduksi_">
                        <option selected disabled hidden>--Kode Produksi--</option>
                        <?php
                          foreach ($production as $key => $value) {
                        ?>
                          <option value="<?php echo $value['kode_produksi'] ?>" <?php echo set_select('_kodeproduksi_', $value['kode_produksi'] ); ?>> <?php echo $value['kode_produksi'] ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_idvendor_" class="col-sm-3 col-form-label" style="text-align: right;">Id Vendor</label>
                    <div class="col-sm-6">
                      <select class="form-control" id="_idvendor_" name="_idvendor_">
                        <option selected disabled hidden>--Id Vendor--</option>
                        <?php
                          foreach ($purchasing as $key => $value) {
                        ?>
                          <option value="<?php echo $value['id_vendor'] ?>" <?php echo set_select('_kodebahan_', $value['id_vendor'] ); ?>> <?php echo $value['id_vendor'] ?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_kodepayroll_" class="col-sm-3 col-form-label" style="text-align: right;">Kode Payroll</label>
                    <div class="col-sm-6">
                      <select class="form-control" id="_kodepayroll_" name="_kodepayroll_">
                        <option selected disabled hidden>--Kode Payroll--</option>
                        <?php
                          foreach ($payroll as $key => $value) {
                        ?>
                          <option value="<?php echo $value['kode_payroll'] ?>" <?php echo set_select('_kodepayroll_', $value['kode_payroll'] ); ?>> <?php echo $value['kode_payroll'] ?></option>
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
          window.location.replace("<?php echo site_url('admin/accounting/table') ?>");
        }
      });
    }

  });
</script>
</body>
</html>
