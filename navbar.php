<?php 
    include 'config.php';
    if(isset($_SESSION['admin_Id'])) {
      header('Location: Admin/dashboard.php');
    } elseif(isset($_SESSION['seller_Id'])) {
      header('Location: Seller/dashboard.php');
    } elseif(isset($_SESSION['buyer_Id'])) {
      header('Location: Buyer/index.php');
    } else {



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <title><?php echo $settings_name; ?></title> -->
  <!---FAVICON ICON FOR WEBSITE--->
   <?php 
     // ACTIVE LOGO
     $fetchpic = mysqli_query($conn, "SELECT * FROM customization WHERE logoStatus=1");
     if(mysqli_num_rows($fetchpic) > 0) {
      while ($pic = mysqli_fetch_array($fetchpic)) {
        echo '<link rel="shortcut icon" type="image/png" href="images-customization/'.$pic['logo'].'">';
      }
    } else {
      echo '<link rel="shortcut icon" type="image/png" href="images/AB.png">';
    }
  ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Font Awesome -->
  <script src="plugins/fontawesome-free/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <link rel="stylesheet" href="css/tempudsdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="css/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="css/jqvmap/jqvmap.min.css"> -->
  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="css/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="css/daterangepicker/daterangepicker.css"> -->
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="css/summernote/summernote-bs4.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Roboto', sans-serif;
  }
  .modal-content{
    -webkit-box-shadow: 0 5px 15px rgba(0,0,0,0);
    -moz-box-shadow: 0 5px 15px rgba(0,0,0,0);
    -o-box-shadow: 0 5px 15px rgba(0,0,0,0);
    box-shadow: 0 5px 15px rgba(0,0,0,0);
  }
</style>

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">

      <a href="index.php" class="navbar-brand">
        <?php 
        // ACTIVE LOGO
        $fetchpic = mysqli_query($conn, "SELECT * FROM customization WHERE logoStatus=1");
        if(mysqli_num_rows($fetchpic) > 0) {
          while ($pic = mysqli_fetch_array($fetchpic)) {
            echo '<img src="images-customization/'.$pic['logo'].'" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8"';
          }
        } else {
          echo '<img src="images/AB.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">';
        }
      ?>
        <span class="brand-text font-weight-light"><?php echo $settings_name; ?></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">All products</a>
          </li>
          <li class="nav-item dropdown ">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Categories</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <?php 
                $getCat = mysqli_query($conn, "SELECT * FROM category");
                while ($rowCat = mysqli_fetch_array($getCat)) {
              ?>
                <li><a href="index_category.php?category_Id=<?php echo $rowCat['cat_id']; ?>" class="dropdown-item"><?php echo $rowCat['cat_name']; ?></a></li>
              <?php } ?>
            </ul>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0  ml-md-" action="" method="POST">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search product" name="search_product" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit" name="search_button">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a href="login.php" class="nav-link">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>

    </div>
  </nav>
  <!-- /.navbar -->
  <?php } ?>