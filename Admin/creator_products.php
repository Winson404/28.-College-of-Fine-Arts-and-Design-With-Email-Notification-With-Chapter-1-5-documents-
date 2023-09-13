<?php 
    include 'navbar.php'; 
    if(isset($_GET['user_Id'])) {
      $user_Id = $_GET['user_Id'];
      $fetch_name = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
      $creator_name = mysqli_fetch_array($fetch_name);
      $c_name = $creator_name['firstname'].' '.$creator_name['middlename'].' '.$creator_name['lastname'].' '.$creator_name['suffix'];
?>
<title><?php echo $settings_name; ?> | <?php echo ucwords($c_name); ?>: Product records</title>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo ucwords($c_name); ?>: Product records</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">E-commerce</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
            <div class="row d-flex justify-content-start">



          <?php 
            $fetch = mysqli_query($conn, "
                SELECT product.*, COALESCE(bids.num_bids, 0) as num_bids
                FROM product
                LEFT JOIN (
                    SELECT product_Id, COUNT(bidding_Id) as num_bids
                    FROM bidding
                    WHERE bidding.bidding_status = 0
                    GROUP BY product_Id
                ) as bids ON product.product_Id = bids.product_Id
                JOIN category ON product.product_cat_Id = category.cat_id
                WHERE product.user_Id = '$user_Id' AND product.product_status = 0
                ORDER BY bids.num_bids DESC
            ");


              if(mysqli_num_rows($fetch) > 0) { 
          ?>

              <div class="col-12 text-primary mb-3">All products</div> 

          <?php
              while ($row = mysqli_fetch_array($fetch)) {
                $productId = $row['product_Id'];
                $countdownId = "countdown-" . $productId;
                $bid_due_date = $row['bid_due_date'];

                // GET MAX BIDDING PRICE
                $sql = mysqli_query($conn, "SELECT *, MAX(CAST(bidding_price AS DECIMAL)) as max_bidding_price 
                FROM bidding
                WHERE product_Id='$productId'
                GROUP BY product_Id
                ORDER BY max_bidding_price DESC
                LIMIT 1;");
                $row_max = mysqli_fetch_array($sql);
                $max_bid_price = $row_max['max_bidding_price'];

          ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                      </div>
                      <a href="product_view.php?product_Id=<?php echo $row['product_Id']; ?>">
                        <div class="card-body" style="margin-bottom: -30px;">
                          <div class="img">
                            <img src="../images-product/<?php echo $row['product_image']; ?>" alt="" class="img-fluid product-image">
                          </div>
                          <p>
                            <?php echo ucwords($row['product_name']); ?><br>
                            <span class="text-sm text-danger">₱<?php echo number_format($row['starting_price'], 2, '.', ','); ?></span> <br>
                            <img src="../images/hourglass.gif" alt="" width="20"> <span class="text-xs text-muted" id="countdown_<?php echo $productId; ?>"></span>
                          </p>
                        </div>
                      </a>
                      <div class="card-footer">
                        <input type="hidden" class="form-control form-control-sm" name="product_Id" value="<?php echo $productId; ?>" id="product_Id_<?php echo $productId; ?>">
                        <p class="text-sm mb-0 float-left">Top price: <a href="product_bidding.php?product_Id=<?php echo $productId; ?>">₱<?php echo number_format($max_bid_price, 2, '.', ','); ?></a></p>
                        <p class="text-sm mb-0 float-right">Buyers: <a href="product_bidding.php?product_Id=<?php echo $productId; ?>"><?php echo $row['num_bids']; ?></a></p>

                      </div>
                    </div>
                </div>
                <script>
                    var countDownDate_<?php echo $productId; ?> = new Date("<?php echo $bid_due_date; ?>").getTime();
                    var countdownInterval_<?php echo $productId; ?> = setInterval(function() {
                      var now = new Date().getTime();
                      var distance = countDownDate_<?php echo $productId; ?> - now;
                      if (distance <= 0) {
                          clearInterval(countdownInterval_<?php echo $productId; ?>);
                          document.getElementById("countdown_<?php echo $productId; ?>").innerHTML = 'Bid has ended!';

                          // Get the value of the input element with an id of "product_Id"
                          var productId = document.getElementById("product_Id_<?php echo $productId; ?>").value = <?php echo $productId; ?>;
                          // Post the productId using AJAX
                          // $.ajax({
                          //     type: "POST",
                          //     url: "process_save.php",
                          //     data: { productId: productId },
                          //     success: function(response) {
                          //         // Handle the successful response from the server
                          //         console.log("POST request successful: " + response);
                          //         console.log(productId);
                          //         location.reload();
                          //     },
                          //     error: function(xhr, status, error) {
                          //         // Handle the error response from the server
                          //         console.error("POST request failed: " + error);
                          //     }
                          // });

                      } else {
                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                          document.getElementById("countdown_<?php echo $productId; ?>").innerHTML = days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ';
                      }
                    }, 1000);
                </script>

                 

          <?php } ?> 
            <div class="col-12 text-center mt-3">
              <br>
              <br>
              <p>You have reached the product lists</p>
              <hr>
              <br>
            </div>
        <?php } else { ?>
              <div class="col-12 text-center d-block m-auto">
                <br>
                <br>
                <p class="mt-2">No product records found.</p>
                <hr>
                <br>
              </div>
          <?php } ?>



          <?php 
            $fetch = mysqli_query($conn, "SELECT *, COUNT(bidding_Id) as num_bids FROM bidding JOIN product ON bidding.product_Id=product.product_Id JOIN category ON product.product_cat_Id=category.cat_id WHERE product.user_Id='$user_Id' AND product.product_status=0 AND bidding.bidding_status=0 GROUP BY bidding.product_Id ORDER BY bidding.bidding_price DESC ");
              if(mysqli_num_rows($fetch) > 0) { 
          ?>

              <div class="col-12 text-primary mb-3">Active products</div> 

          <?php
              while ($row = mysqli_fetch_array($fetch)) {
                $productId = $row['product_Id'];
                $countdownId = "countdown-" . $productId;
                $bid_due_date = $row['bid_due_date'];

                // GET MAX BIDDING PRICE
                $sql = mysqli_query($conn, "SELECT *, MAX(CAST(bidding_price AS DECIMAL)) as max_bidding_price 
                FROM bidding
                WHERE product_Id='$productId'
                GROUP BY product_Id
                ORDER BY max_bidding_price DESC
                LIMIT 1;");
                $row_max = mysqli_fetch_array($sql);
                $max_bid_price = $row_max['max_bidding_price'];

          ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                      </div>
                      <a href="product_view.php?product_Id=<?php echo $row['product_Id']; ?>">
                        <div class="card-body" style="margin-bottom: -30px;">
                          <div class="img">
                            <img src="../images-product/<?php echo $row['product_image']; ?>" alt="" class="img-fluid product-image">
                          </div>
                          <p>
                            <?php echo ucwords($row['product_name']); ?><br>
                            <span class="text-sm text-danger">₱<?php echo number_format($row['starting_price'], 2, '.', ','); ?></span> <br>
                            <img src="../images/hourglass.gif" alt="" width="20"> <span class="text-xs text-muted" id="countdown_<?php echo $productId; ?>"></span>
                          </p>
                        </div>
                      </a>
                      <div class="card-footer">
                        <input type="hidden" class="form-control form-control-sm" name="product_Id" value="<?php echo $productId; ?>" id="product_Id_<?php echo $productId; ?>">
                        <p class="text-sm mb-0 float-left">Top price: <a href="product_bidding.php?product_Id=<?php echo $productId; ?>">₱<?php echo number_format($max_bid_price, 2, '.', ','); ?></a></p>
                        <p class="text-sm mb-0 float-right">Buyers: <a href="product_bidding.php?product_Id=<?php echo $productId; ?>"><?php echo $row['num_bids']; ?></a></p>
                      </div>
                    </div>
                </div>
                <script>
                    var countDownDate_<?php echo $productId; ?> = new Date("<?php echo $bid_due_date; ?>").getTime();
                    var countdownInterval_<?php echo $productId; ?> = setInterval(function() {
                      var now = new Date().getTime();
                      var distance = countDownDate_<?php echo $productId; ?> - now;
                      if (distance <= 0) {
                          clearInterval(countdownInterval_<?php echo $productId; ?>);
                          document.getElementById("countdown_<?php echo $productId; ?>").innerHTML = 'Bid has ended!';

                          // Get the value of the input element with an id of "product_Id"
                          var productId = document.getElementById("product_Id_<?php echo $productId; ?>").value = <?php echo $productId; ?>;
                          // Post the productId using AJAX
                          $.ajax({
                              type: "POST",
                              url: "process_save.php",
                              data: { productId: productId },
                              success: function(response) {
                                  // Handle the successful response from the server
                                  console.log("POST request successful: " + response);
                                  console.log(productId);
                                  location.reload();
                              },
                              error: function(xhr, status, error) {
                                  // Handle the error response from the server
                                  console.error("POST request failed: " + error);
                              }
                          });

                      } else {
                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                          document.getElementById("countdown_<?php echo $productId; ?>").innerHTML = days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ';
                      }
                    }, 1000);
                </script>

              


        <?php } ?> 
            <div class="col-12 text-center mt-3">
              <br>
              <br>
              <p>You have reached the end of the on-going bidding list</p>
              <hr>
              <br>
            </div>
        <?php } else { ?>
              <div class="col-12 text-center d-block m-auto">
                <br>
                <br>
                <p class="mt-2">No active records found.</p>
                <hr>
                <br>
              </div>
        <?php } ?>
          





          <?php 
            $fetch = mysqli_query($conn, "SELECT *, COUNT(bidding_Id) as num_bids FROM bidding JOIN product ON bidding.product_Id=product.product_Id JOIN category ON product.product_cat_Id=category.cat_id WHERE product.user_Id='$user_Id' AND product.product_status=1 AND bidding.bidding_status!=0 AND product.bid_due_date < '$date_today' GROUP BY bidding.product_Id ORDER BY bidding.bidding_price DESC ");
              if(mysqli_num_rows($fetch) > 0) { 
          ?>

              <div class="col-12 text-primary mb-3">Sold products</div> 

          <?php
              while ($row = mysqli_fetch_array($fetch)) {
                $productId = $row['product_Id'];
                $countdownId = "countdown-" . $productId;
                $bid_due_date = $row['bid_due_date'];

                // GET MAX BIDDING PRICE
                $sql = mysqli_query($conn, "SELECT *, MAX(CAST(bidding_price AS DECIMAL)) as max_bidding_price 
                FROM bidding
                WHERE product_Id='$productId'
                GROUP BY product_Id
                ORDER BY max_bidding_price DESC
                LIMIT 1;");
                $row_max = mysqli_fetch_array($sql);
                $max_bid_price = $row_max['max_bidding_price'];

          ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                      </div>
                      <a href="product_view.php?product_Id=<?php echo $row['product_Id']; ?>">
                        <div class="card-body" style="margin-bottom: -30px;">
                          <div class="img">
                            <img src="../images-product/<?php echo $row['product_image']; ?>" alt="" class="img-fluid product-image">
                          </div>
                          <p>
                            <?php echo ucwords($row['product_name']); ?><br>
                            <span class="text-sm text-danger">₱<?php echo number_format($row['starting_price'], 2, '.', ','); ?></span> <br>
                            <img src="../images/hourglass.gif" alt="" width="20"> <span class="text-xs text-muted" id="countdown_<?php echo $productId; ?>"></span>
                          </p>
                        </div>
                      </a>
                      <div class="card-footer">
                        <input type="hidden" class="form-control form-control-sm" name="product_Id" value="<?php echo $productId; ?>" id="product_Id_<?php echo $productId; ?>">
                        <p class="text-sm mb-0 float-left">Top price: <a href="product_bidding.php?product_Id=<?php echo $productId; ?>">₱<?php echo number_format($max_bid_price, 2, '.', ','); ?></a></p>
                        <p class="text-sm mb-0 float-right">Buyers: <a href="product_bidding.php?product_Id=<?php echo $productId; ?>"><?php echo $row['num_bids']; ?></a></p>
                      </div>
                    </div>
                </div>
                <script>
                    var countDownDate_<?php echo $productId; ?> = new Date("<?php echo $bid_due_date; ?>").getTime();
                    var countdownInterval_<?php echo $productId; ?> = setInterval(function() {
                      var now = new Date().getTime();
                      var distance = countDownDate_<?php echo $productId; ?> - now;
                      if (distance <= 0) {
                          clearInterval(countdownInterval_<?php echo $productId; ?>);
                          document.getElementById("countdown_<?php echo $productId; ?>").innerHTML = 'Bid has ended!';
                      } else {
                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                          document.getElementById("countdown_<?php echo $productId; ?>").innerHTML = days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ';
                      }
                    }, 1000);
                </script>

                

        <?php } ?> 
            <div class="col-12 text-center mt-3">
              <br>
              <br>
              <p>You have reached the end of ended bidding list</p>
              <hr>
              <br>
            </div>
        <?php } else { ?>
              <div class="col-12 text-center d-block m-auto">
                <br>
                <br>
                <p class="mt-2">No sold product records found.</p>
                <hr>
                <br>
              </div>
        <?php } ?>





        </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 

<!-- jQuery -->
<?php } else { include '404.php'; } include 'footer.php'; ?>


