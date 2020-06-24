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
            <h1>Edit Purchasing</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/commodity/table') ?>">Purchasing</a></li>
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
              <form action="<?php echo site_url('admin/purchasing/edit/'.$encrypt_id) ?>" class="form-horizontal" method="post">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="_namavendor_" class="col-sm-3 col-form-label" style="text-align: right;">ID Vendor</label>
                    <div class="col-sm-6">
                      <input type="number" name="_idvendor_" class="form-control" id="_idvendor_" placeholder="ID Vendor" value="<?php if (set_value('_idvendor_') != null) { echo set_value('_idvendor_'); } else { echo $purchasing['id_vendor']; } ?>" required="required" minlength="2" maxlength="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_namavendor_" class="col-sm-3 col-form-label" style="text-align: right;">Nama Vendor</label>
                    <div class="col-sm-6">
                      <input type="text" name="_namavendor_" class="form-control" id="_namavendor_" placeholder="Nama Vendor" value="<?php if (set_value('_namavendor_') != null) { echo set_value('_namavendor_'); } else { echo $purchasing['nama_vendor']; } ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_alamatvendor_" class="col-sm-3 col-form-label" style="text-align: right;">Alamat Vendor </label>
                    <div class="col-sm-6">
                      <input type="text" name="_alamatvendor_" class="form-control" id="_alamatvendor_" placeholder="Alamat Vendor" value="<?php if (set_value('_alamatvendor_') != null) { echo set_value('_alamatvendor_'); } else { echo $purchasing['alamat_vendor']; } ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="_tglbeli_" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal Beli</label>
                    <div class="col-sm-6">
                      <input type="date" name="_tglbeli_" class="form-control" id="_tglbeli_" placeholder="Tanggal Beli" value="<?php if (set_value('_tglbeli_') != null) { echo set_value('_tglbeli_'); } else { echo $purchasing['tanggal_beli']; } ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_hargasatuan_" class="col-sm-3 col-form-label" style="text-align: right;">Harga Satuan</label>
                    <div class="col-sm-6">
                      <input type="text" name="_hargasatuan_" class="form-control" id="_hargasatuan_" placeholder="Harga Satuan" value="<?php if (set_value('_hargasatuan_') != null) { echo set_value('_hargasatuan_'); } else { echo $purchasing['harga_satuan']; } ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="_jmlbahan_" class="col-sm-3 col-form-label" style="text-align: right;">Jumlah Bahan</label>
                    <div class="col-sm-6">
                      <input type="number" name="_jumlahbahan_" class="form-control" id="_jumlahbahan_" placeholder="Jumlah Bahan" value="<?php if (set_value('_jumlahbahan_') != null) { echo set_value('_jumlahbahan_'); } else { echo $purchasing['jumlah_bahan']; } ?>" required="required" minlength="2" maxlength="15">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_namabahan_" class="col-sm-3 col-form-label" style="text-align: right;">Nama Bahan</label>
                      <div class="col-sm-6">
                        <select class="form-control" id="_namabahan_" name="_namabahan_" required="required">
                          <option selected disabled hidden>--Nama Bahan--</option>
                          <?php
                            foreach ($inventory as $key => $value) {
                          ?>
                            <option value="<?php echo $value['kode_bahan'] ?>" <?php if (set_select('_namabahan_', $value['kode_bahan'] ) != null) { echo set_select('_namabahan_', $value['kode_bahan'] ); } elseif ($purchasing['inventory_kode_bahan'] == $value['kode_bahan'] ) { echo 'selected'; } ?>> <?php echo $value['nama_bahan'] ?></option>
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
          window.location.replace("<?php echo site_url('admin/purchasing/table') ?>");
        }
      });
    }

  });
</script>
</body>
</html>
