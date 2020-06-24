<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view("admin/partials/head.php") ?>
  <style>
    .clock {
      height: 20vh;
      color: black;
      font-size: 22vh;
      font-family: sans-serif;
      line-height: 20.4vh;
      display: inline-flex;
      position: relative;
      /* background: green; */
      overflow: hidden;
      margin-top: 5px;
      margin-bottom: 20px;
    }


    .clock > div {
      display: flex;
    }

    .tick {
      line-height: 17vh;
    }

    .tick-hidden {
      opacity: 0;
    }

    .move {
      animation: move linear 1s infinite;
    }

    @keyframes move {
      from {
        transform: translateY(0vh);
      }
      to {
        transform: translateY(-20vh);
      }
    }


  </style>
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
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <div class="container-fluid">
              <div class="col-lg-12 col-9">
                <div class="container text-center">
                  <img src="<?php echo base_url('assets/adminlte/dist/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; display: block; margin: auto;">
                  <h1 class="display-4 text-center"><b>Selamat Datang!</b></h1>
                  <p class="lead text-center">My Control Panel</p>

                  <div class="clock">
                    <div class="hours">
                      <div class="first">
                        <div class="number">0</div>
                      </div>
                      <div class="second">
                        <div class="number">0</div>
                      </div>
                    </div>
                    <div class="tick">:</div>
                    <div class="minutes">
                      <div class="first">
                        <div class="number">0</div>
                      </div>
                      <div class="second">
                        <div class="number">0</div>
                      </div>
                    </div>
                    <div class="tick">:</div>
                    <div class="seconds">
                      <div class="first">
                        <div class="number">0</div>
                      </div>
                      <div class="second infinite">
                        <div class="number">0</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>150</h3>
      
                      <p>New Orders</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>53<sup style="font-size: 20px">%</sup></h3>
      
                      <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-chart-bar"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>44</h3>
      
                      <p>User Registrations</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-user-plus"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>65</h3>
      
                      <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-chart-pie"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
        </div>
      </div>
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
  var hoursContainer = document.querySelector('.hours')
  var minutesContainer = document.querySelector('.minutes')
  var secondsContainer = document.querySelector('.seconds')
  var tickElements = Array.from(document.querySelectorAll('.tick'))

  var last = new Date(0)
  last.setUTCHours(-1)

  var tickState = true

  function updateTime () {
    var now = new Date
    
    var lastHours = last.getHours().toString()
    var nowHours = now.getHours().toString()
    if (lastHours !== nowHours) {
      updateContainer(hoursContainer, nowHours)
    }
    
    var lastMinutes = last.getMinutes().toString()
    var nowMinutes = now.getMinutes().toString()
    if (lastMinutes !== nowMinutes) {
      updateContainer(minutesContainer, nowMinutes)
    }
    
    var lastSeconds = last.getSeconds().toString()
    var nowSeconds = now.getSeconds().toString()
    if (lastSeconds !== nowSeconds) {
      //tick()
      updateContainer(secondsContainer, nowSeconds)
    }
    
    last = now
  }

  function tick () {
    tickElements.forEach(t => t.classList.toggle('tick-hidden'))
  }

  function updateContainer (container, newTime) {
    var time = newTime.split('')
    
    if (time.length === 1) {
      time.unshift('0')
    }
    
    
    var first = container.firstElementChild
    if (first.lastElementChild.textContent !== time[0]) {
      updateNumber(first, time[0])
    }
    
    var last = container.lastElementChild
    if (last.lastElementChild.textContent !== time[1]) {
      updateNumber(last, time[1])
    }
  }

  function updateNumber (element, number) {
    //element.lastElementChild.textContent = number
    var second = element.lastElementChild.cloneNode(true)
    second.textContent = number
    
    element.appendChild(second)
    element.classList.add('move')

    setTimeout(function () {
      element.classList.remove('move')
    }, 990)
    setTimeout(function () {
      element.removeChild(element.firstElementChild)
    }, 990)
  }

  setInterval(updateTime, 100)
</script>
</body>
</html>
