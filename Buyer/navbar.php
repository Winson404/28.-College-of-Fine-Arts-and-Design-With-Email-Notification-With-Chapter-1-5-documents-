<?php
    include '../config.php';
    if(isset($_SESSION['buyer_Id'])) {
    $id = $_SESSION['buyer_Id'];

    // RECORD TIME LOGGED IN TO BE USED IN AUTO LOGOUT - CODE CAN BE FOUND ON FOOTER.PHP
    $_SESSION['last_active'] = time();
    $users = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$id'");
    $row = mysqli_fetch_array($users);
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
        echo '<link rel="shortcut icon" type="image/png" href="../images-customization/'.$pic['logo'].'">';
      }
    } else {
      echo '<link rel="shortcut icon" type="image/png" href="../images/AB.png">';
    }
  ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Font Awesome -->
  <script src="../plugins/fontawesome-free/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>
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
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            echo '<img src="../images-customization/'.$pic['logo'].'" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8"';
          }
        } else {
          echo '<img src="../images/AB.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">';
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
          
          <li class="nav-item dropdown ">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dashboard</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="dashboard.php" class="dropdown-item">On-going bidding</a></li>
              <li><a href="dashboard_end_bid.php" class="dropdown-item">Ended bidding</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="transactions.php" class="nav-link">Transactions</a>
          </li>

          
          <li class="nav-item">
            <a href="index.php" class="nav-link">All products</a>
          </li>
         <!--  <li class="nav-item">
            <a href="#" class="nav-link">Contact</a>
          </li> -->
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

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <?php 

        $get = mysqli_query($conn, "SELECT * FROM announcement WHERE actDate='$date_today'");
        $count = mysqli_num_rows($get);

        // LIMIT NUMBER OF CHARACTERS
        function custom_echo($x, $length)
        {
          if(strlen($x)<=$length) {
            echo $x;
          } else {
            $y=substr($x,0,$length) . '...';
            echo $y;
          }
        }

      ?>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php echo $count; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">
            <?php 
                if(mysqli_num_rows($get) < 1) { 
                  echo 'No announcement for today'; 
                } elseif(mysqli_num_rows($get) == 1) {  
                  echo $count. ' announcement notification'; 
                } else {  
                  echo $count. ' announcement notifications'; 
                } 
            ?> 
          </span>
          <div class="dropdown-divider"></div>

          
          <?php 
              if(mysqli_num_rows($get) > 0) {
                while ($r_count = mysqli_fetch_array($get)) {
          ?>
              <a href="#" class="dropdown-item">
                <i class="fa-solid fa-circle-info mr-2"></i> <?php echo custom_echo($r_count['actName'], 15); ?>
                <span class="float-right text-muted text-sm"><?php echo $r_count['actDate']; ?></span>
              </a>
              <div class="dropdown-divider"></div>
          <?php
                }
              }
          ?>

          <?php if(mysqli_num_rows($get) == 1) : ?>
            <a type="button" data-toggle="modal" data-target="#reminder" class="dropdown-item dropdown-footer">See Announcement</a>
          <?php elseif(mysqli_num_rows($get) > 1): ?>
            <a type="button" data-toggle="modal" data-target="#reminder" class="dropdown-item dropdown-footer">See All Announcement</a>
          <?php endif; ?>
        </div>
      </li> -->
        
        <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <!-- <img src="../images-users/<?php echo $row['image']; ?>" alt="User Image" class="mr-3 img-circle" height="50" width="50"> -->
          <img src="../images-users/<?php echo $row['image']; ?>" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?php echo $row['user_type']; ?>: <?php echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-light">
            <img src="../images-users/<?php echo $row['image']; ?>" class="img-circle elevation-2" alt="User Image">
            <p>
              <?php echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?>
              <small><?php echo $row['user_type']; ?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-12 text-center">
                <small>Member since <?php echo date("F d, Y", strtotime($row['date_registered'])); ?></small>
              </div>
              <!-- <div class="col-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Friends</a>
              </div> -->
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
            <a href="#" class="btn btn-default btn-flat float-right" onclick="logout()">Sign out</a>
          </li>
        </ul>
      </li>

      <!-- FULL SCREEN -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- END FULL SCREEN -->

      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

<script>

    function logout() {
        swal({
          title: 'Are you sure you want to logout?',
          text: "You won't be able to revert this!",
          icon: "warning",
          buttons: true,
          // dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
          //   swal("Poof! Your imaginary file has been deleted!", {
          //   icon: "success",
          // }); 
            window.location = "../logout.php";
            
          } else {
            // swal("Poof! Your imaginary file has been deleted!", {
            //       icon: "info",
            //     }); 
          }
        });
    }
</script>

<script src="../sweetalert2.min.js"></script>
<?php include '../sweetalert_messages.php'; ?>
<?php
// ------------------------------CLOSING THE SESSION OF THE LOGGED IN USER WITH else statement----------//
    } else {
     header('Location: ../login.php');
    }
?>