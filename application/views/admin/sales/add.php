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
            <h1>Add Sales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/sales/table') ?>">Sales</a></li>
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
              <form action="<?php echo site_url('admin/sales/add') ?>" class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_kodepenjualan_" class="col-sm-3 col-form-label" style="text-align: right;">Kode Penjualan</label>
                    <div class="col-sm-6">
                      <input type="text" name="_kodepenjualan_" class="form-control" id="_kodepenjualan_" placeholder="Kode Penjualan" value="<?php echo set_value('_kodepenjualan_'); ?>" required="required" minlength="2" maxlength="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_ppn_" class="col-sm-3 col-form-label" style="text-align: right;">PPN</label>
                    <div class="col-sm-6">
                      <input type="number" name="_ppn_" class="form-control" id="_ppn_" placeholder="PPN" value="<?php echo set_value('_ppn_'); ?>" required="required" minlength="1" maxlength="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_hargajual_" class="col-sm-3 col-form-label" style="text-align: right;">Harga Jual</label>
                    <div class="col-sm-6">
                      <input type="number" name="_hargajual_" class="form-control" id="_hargajual_" placeholder="Harga Jual" value="<?php echo set_value('_hargajual_'); ?>" required="required" minlength="2" maxlength="11">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_jumlahprodukterjual_" class="col-sm-3 col-form-label" style="text-align: right;">Jumlah Produk Terjual</label>
                    <div class="col-sm-6">
                      <input type="number" name="_jumlahprodukterjual_" class="form-control" id="_jumlahprodukterjual_" placeholder="Jumlah Produk Terjual" value="<?php echo set_value('_jumlahprodukterjual_'); ?>" required="required" minlength="1" maxlength="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_kodedistributor_" class="col-sm-3 col-form-label" style="text-align: right;">Kode Distributor</label>
                    <div class="col-sm-6">
                      <input type="text" name="_kodedistributor_" class="form-control" id="_kodedistributor_" placeholder="Kode Distributor" value="<?php echo set_value('_kodedistributor_'); ?>" required="required" minlength="2" maxlength="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_namadistributor_" class="col-sm-3 col-form-label" style="text-align: right;">Nama Distributor</label>
                    <div class="col-sm-6">
                      <input type="text" name="_namadistributor_" class="form-control" id="_namadistributor_" placeholder="Nama Distributor" value="<?php echo set_value('_namadistributor_'); ?>" required="required" minlength="2" maxlength="45">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_alamatdistributor_" class="col-sm-3 col-form-label" style="text-align: right;">Alamat Distributor</label>
                    <div class="col-sm-6">
                      <input type="text" name="_alamatdistributor_" class="form-control" id="_alamatdistributor_" placeholder="Alamat Distributor" value="<?php echo set_value('_alamatdistributor_'); ?>" required="required" minlength="2" maxlength="45">
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
          window.location.replace("<?php echo site_url('admin/sales/table') ?>");
        }
      });
    }

  });
</script>
</body>
</html>
