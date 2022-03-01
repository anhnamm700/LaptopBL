<?php
  session_start();
  include_once '../connect.php';
  
  if (isset($_SESSION['email'])) {
    $name = $_SESSION['email'];
    $sqlSelect = "select AccountName from account where Email like '$name'";   
    $result = mysqli_query($conn, $sqlSelect);

    $row = mysqli_fetch_array($result);
  }

  // $sqlAll = "select * from account where AuthoritiesID IN (1, 3)";
  // $results = mysqli_query($conn, $sqlAll);

  // $rows = mysqli_fetch_array($results);

  if (isset($_SESSION['email']) == true && isset($_SESSION['pass']) == true) {

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://kit.fontawesome.com/8862f54ebe.js" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./assets/plugins/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="./assets/plugins/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./assets/plugins/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="./assets/plugins/jqvmap/jqvmap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="./assets/plugins/daterangepicker/daterangepicker.css"> -->
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="./assets/plugins/summernote/summernote-bs4.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .icon-nav {
      display: inline-block;
      width: 26px;
      text-align: center;
    }

    .avtive-nav {
      background-color: blue;
      color: #fff;
    }

    .non-active {
      background-color: #6c757d;
    }

  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="display: flex; justify-content: space-between;">
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <ul class="navbar-nav ml-auto" style="margin-left: 100px;">
      <li class="nav-item dropdown" style="display: flex; align-items: center;">Xin chào, 
        <a class="nav-link" data-toggle="dropdown" href="#" style="color: #3498db;">
          <!-- <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span> -->
          <?php 
            if (isset($_SESSION['email'])) { echo $row['AccountName']; } 
            
            ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <span class="dropdown-item dropdown-header">15 Notifications</span> -->
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            Thông tin tài khoản
          </a>
          <div class="dropdown-divider"></div>
          <a href="LogOut.php" class="dropdown-item">
            Đăng xuất
          </a>
      </li>
    </ul>    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link">
              <span><i class="icon-nav  fas fa-home"></i></span>
              <p>
                Trang chủ
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowOrder" class="nav-link">
            <span><i class="icon-nav  fas fa-shopping-cart"></i></span>
              <p>
                Quản lí giỏ hàng
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowAccount" class="nav-link">
            <span><i class="icon-nav  fas fa-user"></i></span>
              <p>
                Quản lí tài khoản
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowBrand" class="nav-link">
            <span><i class="icon-nav  fas fa-copyright"></i></span>
              <p>
                Quản lí thương hiệu
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowProduct" class="nav-link">
            <span><i class="icon-nav  fas fa-box-open"></i></span>
              <p>
                Quản lí sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowBanner" class="nav-link">
            <span><i class="icon-nav  fab fa-adversal"></i></span>
              <p>
                Quản lí banner
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowNews" class="nav-link">
            <span><i class="icon-nav  fas fa-newspaper"></i></span>
              <p>
                Quản lí bài viết
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowColor" class="nav-link">
            <span><i class="icon-nav  fas fa-palette"></i></span>
              <p>
                Quản lí màu sắc
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowRam" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quản lí bộ nhớ RAM
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowSsd" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quản lí bộ nhớ SSD
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowHdd" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quản lí bộ nhớ HDD
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=ShowVga" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quản lí VGA
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="index.php?page=Config" class="nav-link">
            <span><i class="icon-nav  fas fa-cog"></i></span>
              <p>
                Cấu hình website
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <?php
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'ShowOrder': 
                      include_once './Order/ShowOrder.php';
                      break;
                    case 'OrderDetail': 
                      include_once './Order/OrderDetail.php';
                      break;
                    case 'OrderUpdate': 
                      include_once './Order/OrderUpdate.php';
                      break;
                    case 'OrderDel': 
                      include_once './Order/OrderDel.php';
                      break;
                    case 'ShowAccount': 
                      include_once './Account/ShowAccount.php';
                      break;
                    case 'AccountRepair': 
                      include_once './Account/AccountRepair.php';
                      break;
                    case 'AccountDel': 
                      include_once './Account/AccountDel.php';
                      break;
                    case 'AddAccount': 
                      include_once './Account/AddAccount.php';
                      break;
                    case 'ShowBrand': 
                      include_once './Brand/ShowBrand.php';
                      break;
                    case 'BrandRepair': 
                      include_once './Brand/BrandRepair.php';
                      break;
                    case 'BrandDel': 
                      include_once './Brand/BrandDel.php';
                      break;
                    case 'AddBrand': 
                      include_once './Brand/AddBrand.php';
                      break;
                    case 'ShowProduct': 
                      include_once './Product/ShowProduct.php';
                      break;
                    case 'ProductRepair': 
                      include_once './Product/ProductRepair.php';
                      break;
                    case 'ProductDel': 
                      include_once './Product/ProductDel.php';
                      break;
                    case 'AddProduct': 
                      include_once './Product/AddProduct.php';
                      break;
                    case 'ShowColor': 
                      include_once './Color/ShowColor.php';
                      break;
                    case 'ColorRepair': 
                      include_once './Color/ColorRepair.php';
                      break;
                    case 'ColorDel': 
                      include_once './Color/ColorDel.php';
                      break;
                    case 'AddColor': 
                      include_once './Color/AddColor.php';
                      break;
                    case 'ShowRam': 
                      include_once './Ram/ShowRam.php';
                      break;
                    case 'RamRepair': 
                      include_once './Ram/RamRepair.php';
                      break;
                    case 'RamDel': 
                      include_once './Ram/RamDel.php';
                      break;
                    case 'AddRam': 
                      include_once './Ram/AddRam.php';
                      break;
                    case 'ShowSsd': 
                      include_once './Ssd/ShowSsd.php';
                      break;
                    case 'SsdRepair': 
                      include_once './Ssd/SsdRepair.php';
                      break;
                    case 'SsdDel': 
                      include_once './Ssd/SsdDel.php';
                      break;
                    case 'AddSsd': 
                      include_once './Ssd/AddSsd.php';
                      break;
                    case 'ShowHdd': 
                      include_once './Hdd/ShowHdd.php';
                      break;
                    case 'HddRepair': 
                      include_once './Hdd/HddRepair.php';
                      break;
                    case 'HddDel': 
                      include_once './Hdd/HddDel.php';
                      break;
                    case 'AddHdd': 
                      include_once './Hdd/AddHdd.php';
                      break;
                    case 'ShowVga': 
                      include_once './Vga/ShowVga.php';
                      break;
                    case 'VgaRepair': 
                      include_once './Vga/VgaRepair.php';
                      break;
                    case 'VgaDel': 
                      include_once './Vga/VgaDel.php';
                      break;
                    case 'AddVga': 
                      include_once './Vga/AddVga.php';
                      break;
                    case 'ShowBanner': 
                      include_once './Banner/ShowBanner.php';
                      break;
                    case 'BannerRepair': 
                      include_once './Banner/BannerRepair.php';
                      break;
                    case 'BannerDel': 
                      include_once './Banner/BannerDel.php';
                      break;
                    case 'AddBanner': 
                      include_once './Banner/AddBanner.php';
                      break;
                    case 'Config': 
                      include_once './Config/Config.php';
                      break;
                    case 'ShowNews': 
                      include_once './News/ShowNews.php';
                      break;
                    case 'NewsRepair': 
                      include_once './News/NewsRepair.php';
                      break;
                    case 'NewsDel': 
                      include_once './News/NewsDel.php';
                      break;
                    case 'AddNews': 
                      include_once './News/AddNews.php';
                      break;
                    case 'CustomersList': 
                      include_once './Account/CustomersList.php';
                      break;
                    case 'ModeratorsList': 
                      include_once './Account/ModeratorsList.php';
                      break;
                }
            } else {
                include_once './Chart.php';
            }
        ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="./assets/plugins/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./assets/plugins/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./assets/plugins/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="./assets/plugins/jqvmap/jquery.vmap.min.js"></script> -->
<!-- <script src="./assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="./assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./assets/plugins/moment/moment.min.js"></script>
<script src="./assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./assets/dist/js/demo.js"></script>

<script>
  let navList = document.querySelectorAll(".nav-item");

  for (let i = 0; i < navList.length; i++) {
    navList[i].onclick = function() {
      navList[i].classList.add("active");
    }
  }

</script>


</body>
</html>

<?php
  } else {
    header('location: Login.php');
  }
?>
