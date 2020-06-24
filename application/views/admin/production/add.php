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
            <h1>Add Production</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/production/table') ?>">Production</a></li>
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
              <form action="<?php echo site_url('admin/production/add') ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_kodeproduksi_" class="col-sm-3 col-form-label" style="text-align: right;">Kode Produksi</label>
                    <div class="col-sm-6">
                      <input type="text" name="_kodeproduksi_" class="form-control" id="_kodeproduksi_" placeholder="Kode Produksi" value="<?php echo set_value('_kodeproduksi_'); ?>" required="required" minlength="2" maxlength="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_tanggalproduksi_" class="col-sm-3 col-form-label" style="text-align: right;">Tanggal Produksi</label>
                    <div class="col-sm-6">
                      <input type="date" name="_tanggalproduksi_" class="form-control" id="_tanggalproduksi_" placeholder="Tanggal Produksi" value="<?php echo set_value('_tanggalproduksi_'); ?>" required="required">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_namaproduk_" class="col-sm-3 col-form-label" style="text-align: right;">Nama Produk</label>
                    <div class="col-sm-6">
                      <input type="text" name="_namaproduk_" class="form-control" id="_namaproduk_" placeholder="Nama Produk" value="<?php echo set_value('_namaproduk_'); ?>" required="required" minlength="2" maxlength="45">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_jumlahproduksi_" class="col-sm-3 col-form-label" style="text-align: right;">Jumlah Produksi</label>
                    <div class="col-sm-6">
                      <input type="number" name="_jumlahproduksi_" class="form-control" id="_jumlahproduksi_" placeholder="Jumlah Produksi" value="<?php echo set_value('_jumlahproduksi_'); ?>" required="required" minlength="1" maxlength="11">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_biayaproduksi_" class="col-sm-3 col-form-label" style="text-align: right;">Biaya Produksi</label>
                    <div class="col-sm-6">
                      <input type="number" name="_biayaproduksi_" class="form-control" id="_biayaproduksi_" placeholder="Biaya Produksi" value="<?php echo set_value('_biayaproduksi_'); ?>" required="required" minlength="3" maxlength="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_image_" class="col-sm-3 col-form-label" style="text-align: right;">Image</label>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-3">
                          <img src="<?php echo base_url('assets/images/default.png')?>" id="img-preview" alt="Preview Image" class="img-thumbnail">
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

                  <div class="form-group row">
                    <label for="_kodebahan_" class="col-sm-3 col-form-label" style="text-align: right;">Nama Bahan</label>
                    <div class="col-sm-6">
                      <select class="form-control" id="_kodebahan_" name="_kodebahan_">
                        <option selected disabled hidden>--Nama Bahan--</option>
                        <?php
                          foreach ($inventory as $key => $value) {
                        ?>
                          <option value="<?php echo $value['kode_bahan'] ?>" <?php echo set_select('_kodebahan_', $value['kode_bahan'] ); ?>> <?php echo $value['nama_bahan'] ?></option>
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

  function img_pathUrl(input){
    $('#img-preview')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
  }

  $(document).ready(function(){
     // If you upload an image
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
      $("#img-preview").attr("src","<?php echo base_url('uploads/production/default.png')?>");
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
          window.location.replace("<?php echo site_url('admin/production/table') ?>");
        }
      });
    }

  });
</script>
</body>
</html>
