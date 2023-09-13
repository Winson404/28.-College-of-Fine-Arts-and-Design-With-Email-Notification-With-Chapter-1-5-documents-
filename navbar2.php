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
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Font Awesome -->
  <script src="plugins/fontawesome-free/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper" >

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="login.php" class="navbar-brand">
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
        <span class="brand-text font-weight-light"> <?php echo $settings_name; ?></span>
        <!-- <img src="images/AB.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <!-- <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>
            </ul>
          </li>
        </ul> -->

        <!-- SEARCH FORM -->
        <!-- <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> -->
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
            <a href="login.php" class="nav-link">Login</a>
          </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
  <?php } ?>