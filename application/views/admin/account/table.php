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
            <h1>Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/account/table') ?>">Account</a></li>
              <li class="breadcrumb-item active">Table</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Account Data</h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a href="<?php echo site_url('admin/account/add')?>">
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus-square"></i> Add Account</button>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="_account_" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Level</th>
                  <th>CreateAt</th>
                  <th>ModifyAt</th>
                  <th>IsActive</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
  var account;


  function setSwitch(id,isactive){
    $.ajax({
      type: "POST",
      data: { id: id, isactive: isactive },
      url: "<?php echo site_url('admin/API/account/update')?>",
      dataType: "JSON",
      success: function (data) {
        if (data.status == "success") {
          account.ajax.reload();
          Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: data.message
          });
        } else {
          account.ajax.reload();
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: data.message
          })
        }
      }
    });
  }

  function delAccount(id){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          data: { id: id},
          url: "<?php echo site_url('admin/API/account/delete')?>",
          dataType: "JSON",
          success: function (data) {
            if (data.status == "success") {
              account.ajax.reload();
              Swal.fire({
                icon: 'success',
                title: 'Success...',
                text: data.message
              });
            } else {
              account.ajax.reload();
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.message
              })
            }
          }
        });
      }
    })
  }
  


  $(document).ready(function(){
    account = $("#_account_").DataTable({
      ajax: {
        url: "<?php echo site_url('admin/API/account/data')?>",
        type: "POST",
        dataSrc: ""
      },
      columns: [
        {data: null},
        {data: "account_name"},
        {data: "account_username"},
        {data: "account_level"},
        {data: "account_createat"},
        {data: "account_modifyat"},
        {
          data: "account_isactive",
          render: function(data, type, row){
            if (data == "true") {
              return "<input type='checkbox' class='isactive' data-id='"+row.account_id+"' data-isactive='"+data+"' checked data-bootstrap-switch>";
            } else {
              return "<input type='checkbox' class='isactive' data-id='"+row.account_id+"' data-isactive='"+data+"' data-bootstrap-switch>";
            }
          }
        },
        {
          data: "account_id",
          render: function(data, type, row){
            const setDelUser = '"'+data+'"';
            return "\
              <a href='<?php echo site_url('admin/account/edit/')?>"+data+"' data-toggle='tooltip' title='Edit'>\
                  <button type='button' class='btn btn-warning'><i class='fa fa-edit'></i></button>\
              </a>\
              <a onclick='delAccount("+setDelUser+")' data-toggle='tooltip' title='Delete'>\
                  <button type='button' class='btn btn-danger'><i class='fa fa-trash'></i></button>\
              </a>";
          }
        }
      ],
      "createdRow": function (row, data, index) {
        var elems = Array.prototype.slice.call($(row).find('.isactive'));
        elems.forEach(function (html) {
          $(html).bootstrapSwitch();
        });
      },
      // "drawCallback":function( settings ){
      //   $('.isactive').on('switchChange.bootstrapSwitch', function (event, state) {
      //     setSwitch($(this).data("id"), $(this).data("isactive"));
      //   }); 
      // }
    });

    account.on( 'order.dt search.dt', function () {
      account.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
      } );
    } ).draw();

    account.on('switchChange.bootstrapSwitch', '.isactive', function(event, state) {
      setSwitch($(this).data("id"), $(this).data("isactive"));
    });

  });
</script>
</body>
</html>
