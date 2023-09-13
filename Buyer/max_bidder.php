<?php 
    include 'navbar.php'; 
    if(isset($_GET['user_Id'])) {

      $user_Id = $_GET['user_Id'];
      $count = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
      $count_pro = mysqli_fetch_array($count);


?>
<title><?php echo $settings_name; ?> | Max Bidders information</title>


  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Max Bidders </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Max Bidders info</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row d-flex justify-content-center">

           <div class="col-lg-5 col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  <?php echo $count_pro['user_type']; ?>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-8">
                      <h2 class="lead"><b><?php echo ' '.$count_pro['firstname'].' '.$count_pro['middlename'].' '.$count_pro['lastname'].' '.$count_pro['suffix'].' '; ?></b></h2>
                      <p class="text-muted text-sm"><b>Civil Status: </b> <?php echo $count_pro['civilstatus']; ?> </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building text-dark"></i></span> Address: <?php echo ''.$count_pro['house_no'].' '.$count_pro['street_name'].' '.$count_pro['purok'].' '.$count_pro['zone'].' '.$count_pro['barangay'].' '.$count_pro['municipality'].' '.$count_pro['province'].' '.$count_pro['region'].''; ?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone text-primary"></i></span> Phone #: +63 <?php echo $count_pro['contact']; ?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope text-danger"></i></span> Email : <?php echo $count_pro['email']; ?></li>

                        <!-- <hr>
                        <li class="mb-2 text-dark">Payment Methods</li>
                        <li class="small">
                          <span class="fa-li">
                            <img src="../images/GCash_Logo.png" alt="" class="img-circle" width="17" height="17">
                          </span> GCash #: +63 <?php echo $count_pro['contact']; ?> | <a href="https://m.gcash.com/gcash-login-web/index.html#/">GCash Login</a>
                        </li>
                        <li class="small">
                          <span class="fa-li">
                            <img src="../images/paypal.png" alt="" class="img-circle" width="17" height="17">
                          </span> Paypal :<?php echo $count_pro['email']; ?> | <a href="https://www.paypal.com/ph/signin">Paypal Login</a>
                        </li> -->

                      </ul>
                    </div>
                    <div class="col-4 text-center">
                      <img src="../images-users/<?php echo $count_pro['image']; ?>" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="dashboard.php" class="btn btn-sm btn-primary">
                      <i class="fa-solid fa-backward"></i> Back
                    </a>
                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>
    </div>
  </div>


  
<?php include 'footer.php'; ?>

<?php } else { include '404.php'; } ?>

