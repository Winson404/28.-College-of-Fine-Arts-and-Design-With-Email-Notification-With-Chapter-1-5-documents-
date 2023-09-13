<?php include 'navbar.php'; ?>
<title><?php echo $settings_name; ?> | Login</title>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-dark" >
    
    <!-- Main content -->
    <div class="content text-dark">
      <div class="container">
        <div class="row d-flex justify-content-center">

          <div class="col-lg-4 col-md-4 col-sm-6 col-12 card m-5 shadow-md">
              <div class="card-header text-center justify-content-center d-flex">
                  <a href="login.php" class="h1">
                    <?php 
                      $fetchpic = mysqli_query($conn, "SELECT * FROM customization WHERE logoStatus=1");
                      if(mysqli_num_rows($fetchpic) > 0) {
                        while ($pic = mysqli_fetch_array($fetchpic)) {
                          echo '<img src="images-customization/'.$pic['logo'].'" alt="" class="img-fluid" width="120">';
                        }
                      } else {
                        echo '<img src="images/AB.png" alt="logo" class="img-fluid shadow-sm img-circle" width="120">';
                      }
                    ?>
                    <!-- <img src="images/AB.png" alt="logo" class="img-fluid shadow-sm img-circle" width="120"> -->
                  </a>
              </div>
              
            <div class="card-body">
              <p class="login-box-msg">Sign in to start your session</p>
              <form action="processes.php" method="post" id="quickForm">
                <div class="input-group">
                  <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" >
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <!-- FOR INVALID EMAIL -->
                <div class="input-group mt-1 mb-3">
                  <small id="text" style="font-style: italic;"></small>
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Password" id="password" name="password" minlength="8" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                      <input type="checkbox" id="remember" id="remember" onclick="myFunction()">
                      <label for="remember">
                        Show password
                      </label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn bg-gradient-primary btn-block" name="login" id="login">Sign In</button>
                  </div>
                </div>
              </form>
              <p>
                <a href="forgot-password.php" class="font-italic">Forgot password?</a>
                <br>
                No account? Register as <a href="register_seller.php" class="text-center"><b>Seller</b></a> | <a href="register_buyer.php" class="text-center"><b>Bidder</b></a>
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
    <br>
  </div>

<?php include 'footer.php'; ?>
