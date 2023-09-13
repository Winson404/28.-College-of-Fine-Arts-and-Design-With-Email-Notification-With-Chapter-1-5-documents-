<?php include 'navbar.php'; ?>
<title><?php echo $settings_name; ?> | Products information</title>
<style>
  .card-body .img img {
    height: 200px; /* set a fixed height */
    object-fit: cover; /* use "cover" to scale the image while maintaining aspect ratio */
  }

  .card-body .product-image {
    height: 200px; /* set a fixed height */
    object-fit: cover; /* use "cover" to scale the image while maintaining aspect ratio */
  }
</style>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Ended bidding products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Product info</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row d-flex justify-content-start">
          <?php 
            if(isset($_POST['search_button'])) {
              $search_product = mysqli_real_escape_string($conn, $_POST['search_product']);
              $fetch = mysqli_query($conn, "SELECT * FROM bidding JOIN product ON bidding.product_Id=product.product_Id JOIN category ON product.product_cat_Id=category.cat_id WHERE bidding.user_Id='$id' AND product.product_status=1 AND product.bid_due_date <= '$date_today' AND product.product_name LIKE '%$search_product%' ORDER BY bidding.bidding_Id DESC ");
              if(mysqli_num_rows($fetch) > 0) {
                while ($row = mysqli_fetch_array($fetch)) {
                  $productId = $row['product_Id'];
                  $countdownId = "countdown-" . $productId;
                  $bid_due_date = $row['bid_due_date'];
                  $myPrice = $row['bidding_price'];


                  // GET SELLERS INFO
                  $seller = mysqli_query($conn, "SELECT * FROM product JOIN users ON product.user_Id=users.user_Id WHERE product_Id='$productId'");
                  $nameSeller = mysqli_fetch_array($seller);
                  $seller_Id = $nameSeller['user_Id'];



                  // GET MAX BIDDING PRICE
                  $sql = mysqli_query($conn, "SELECT *, MAX(CAST(bidding_price AS DECIMAL)) as max_bidding_price 
                  FROM bidding
                  WHERE product_Id='$productId'
                  GROUP BY product_Id
                  ORDER BY max_bidding_price DESC
                  LIMIT 1;");
                  $row_max = mysqli_fetch_array($sql);
                  $max_bid_price = $row_max['max_bidding_price'];

                  // HIGHEST BIDDER
                  $highestBidder   = mysqli_query($conn, "SELECT * FROM bidding JOIN users ON bidding.user_Id=users.user_Id WHERE bidding_price='$max_bid_price'");
                  $name_Of         = mysqli_fetch_array($highestBidder);
                  $nameofmaxbidder = $name_Of['user_Id'];
                  $bidofUser       = $name_Of['bidding_price'];


                  // GET MIN BIDDING PRICE
                  $sql2 = mysqli_query($conn, "SELECT *, MIN(CAST(bidding_price AS DECIMAL)) as min_bidding_price 
                  FROM bidding
                  WHERE product_Id='$productId'
                  GROUP BY product_Id
                  ORDER BY min_bidding_price DESC
                  LIMIT 1;");
                  $row_min = mysqli_fetch_array($sql2);
                  $min_bid_price = $row_min['min_bidding_price'];
          ?>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                      <div class="card bg-light d-flex flex-fill">
                        <!-- <div class="card-header text-muted border-bottom-0">
                        </div> -->
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
                          <p class="text-sm mb-0 float-left">Top: <a href="#">₱<?php echo number_format($max_bid_price, 2, '.', ','); ?></a></p>
                            <p class="text-sm mb-0 float-right">You: 
                              <?php if($row['bidding_status'] == 0): ?>
                                <span class="text-info">have bidded</span>
                              <?php elseif($row['bidding_status'] == 1): ?>
                                <span class="text-success">Won</span>
                              <?php else: ?>
                                <span class="text-danger">Lost</span>
                              <?php endif; ?>
                              <!-- <span id="bidStatus_<?php echo $productId; ?>"></span> -->
                            </p> 
                            <br>
                            <p class="text-sm">View Seller : 
                              <?php if($row['bidding_status'] == 1): ?>
                                <a href="sellers_info.php?user_Id=<?php echo $seller_Id; ?>" type="button">Seller's info </a>
                              <?php else: ?>
                                <a href="#">Unavailable</a>
                              <?php endif; ?>
                            </p>

                            <?php if($myPrice >= $max_bid_price) : ?>
                              <p class="text-sm mb-0">Status: <a href="#" type="button">You are the highest bidder </a></p>
                            <?php elseif($myPrice > $min_bid_price) : ?>
                              <p class="text-sm mb-0">Status:
                              <a href="max_bidder.php?user_Id=<?php echo $nameofmaxbidder; ?>" type="button">Someone has higher bidder </a>
                              <?php if($bid_due_date > $date_today) { ?>
                                <form action="process_update.php" method="POST">
                                  <div class="input-group">
                                    <input type="hidden" class="form-control form-control-sm" name="user_Id" value="<?php echo $id; ?>">
                                    <input type="hidden" class="form-control form-control-sm" name="product_Id" value="<?php echo $productId; ?>" id="product_Id_<?php echo $productId; ?>">
                                    <input type="number" class="form-control form-control-sm" placeholder="Enter bidding price..." id="bidInput_<?php echo $productId; ?>" name="bidding_price">
                                    <div class="input-group-append">
                                      <button class="btn btn-primary btn-sm" type="submit" name="update_bidding">
                                        <i class="fa-solid fa-paper-plane"></i>
                                      </button>
                                    </div>
                                  </div>
                                </form>
                                <span id="errorMessage_<?php echo $productId; ?>" style="display: none;" class="font-italic text-xs text-danger text-bold"></span>
                              <?php } ?>
                              </p>
                            <?php else: ?>
                              <p class="text-sm mb-0">Status:
                              <a href="max_bidder.php?user_Id=<?php echo $nameofmaxbidder; ?>" type="button">You are the lowest bidder </a>
                              <?php if($bid_due_date > $date_today) { ?>
                                <form action="process_update.php" method="POST">
                                  <div class="input-group">
                                    <input type="hidden" class="form-control form-control-sm" name="user_Id" value="<?php echo $id; ?>">
                                    <input type="hidden" class="form-control form-control-sm" name="product_Id" value="<?php echo $productId; ?>" id="product_Id_<?php echo $productId; ?>">
                                    <input type="number" class="form-control form-control-sm" placeholder="Enter bidding price..." id="bidInput_<?php echo $productId; ?>" name="bidding_price">
                                    <div class="input-group-append">
                                      <button class="btn btn-primary btn-sm" type="submit" name="update_bidding">
                                        <i class="fa-solid fa-paper-plane"></i>
                                      </button>
                                    </div>
                                  </div>
                                </form>
                                <span id="errorMessage_<?php echo $productId; ?>" style="display: none;" class="font-italic text-xs text-danger text-bold"></span>
                              <?php } ?>
                              </p>
                            <?php endif; ?>
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

                            // // Get the value of the input element with an id of "product_Id"
                            // var productId = document.getElementById("product_Id_<?php echo $productId; ?>").value = <?php echo $productId; ?>;
                            // // Post the productId using AJAX
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

          <?php } //END OF WHILE LOOP ?>  

                <div class="col-12 text-center mt-3">
                  <p>You have reached the end of the list</p>
                  <hr>
                </div> 
                
          <?php  } /*END OF IF MYSQLI_NUM_ROWS > 0*/
          else { ?>

              <div class="text-center d-block m-auto">
                <img src="../images/hack-khaby.gif" alt="No results found" class="img-fluid" width="250">
                <p class="mt-2">Sorry, no results found.</p>
              </div>
          <?php } } /*END OF IF ISSET FUNCTION*/
          else { 
            $fetch = mysqli_query($conn, "SELECT * FROM bidding JOIN product ON bidding.product_Id=product.product_Id JOIN category ON product.product_cat_Id=category.cat_id WHERE bidding.user_Id='$id' AND product.product_status=1 AND product.bid_due_date <= '$date_today' ORDER BY bidding.bidding_Id DESC ");
              if(mysqli_num_rows($fetch) > 0) {
                while ($row = mysqli_fetch_array($fetch)) {
                  $productId = $row['product_Id'];
                  $countdownId = "countdown-" . $productId;
                  $bid_due_date = $row['bid_due_date'];
                  $myPrice = $row['bidding_price'];


                  // GET SELLERS INFO
                  $seller = mysqli_query($conn, "SELECT * FROM product JOIN users ON product.user_Id=users.user_Id WHERE product_Id='$productId'");
                  $nameSeller = mysqli_fetch_array($seller);
                  $seller_Id = $nameSeller['user_Id'];



                  // GET MAX BIDDING PRICE
                  $sql = mysqli_query($conn, "SELECT *, MAX(CAST(bidding_price AS DECIMAL)) as max_bidding_price 
                  FROM bidding
                  WHERE product_Id='$productId'
                  GROUP BY product_Id
                  ORDER BY max_bidding_price DESC
                  LIMIT 1;");
                  $row_max = mysqli_fetch_array($sql);
                  $max_bid_price = $row_max['max_bidding_price'];

                  // HIGHEST BIDDER
                  $highestBidder   = mysqli_query($conn, "SELECT * FROM bidding JOIN users ON bidding.user_Id=users.user_Id WHERE bidding_price='$max_bid_price'");
                  $name_Of         = mysqli_fetch_array($highestBidder);
                  $nameofmaxbidder = $name_Of['user_Id'];
                  $bidofUser       = $name_Of['bidding_price'];


                  // GET MIN BIDDING PRICE
                  $sql2 = mysqli_query($conn, "SELECT *, MIN(CAST(bidding_price AS DECIMAL)) as min_bidding_price 
                  FROM bidding
                  WHERE product_Id='$productId'
                  GROUP BY product_Id
                  ORDER BY min_bidding_price DESC
                  LIMIT 1;");
                  $row_min = mysqli_fetch_array($sql2);
                  $min_bid_price = $row_min['min_bidding_price'];
          ?>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                      <div class="card bg-light d-flex flex-fill">
                        <!-- <div class="card-header text-muted border-bottom-0">
                        </div> -->
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
                          <p class="text-sm mb-0 float-left">Top: <a href="#">₱<?php echo number_format($max_bid_price, 2, '.', ','); ?></a></p>
                            <p class="text-sm mb-0 float-right">You: 
                              <?php if($row['bidding_status'] == 0): ?>
                                <span class="text-info">have bidded</span>
                              <?php elseif($row['bidding_status'] == 1): ?>
                                <span class="text-success">Won</span>
                              <?php else: ?>
                                <span class="text-danger">Lost</span>
                              <?php endif; ?>
                              <!-- <span id="bidStatus_<?php echo $productId; ?>"></span> -->
                            </p> 
                            <br>
                            <p class="text-sm">View Seller : 
                              <?php if($row['bidding_status'] == 1): ?>
                                <a href="sellers_info.php?user_Id=<?php echo $seller_Id; ?>" type="button">Seller's info </a>
                              <?php else: ?>
                                <a href="#">Unavailable</a>
                              <?php endif; ?>
                            </p>

                            <?php if($myPrice >= $max_bid_price) : ?>
                              <p class="text-sm mb-0">Status: <a href="#" type="button">You are the highest bidder </a></p>
                            <?php elseif($myPrice > $min_bid_price) : ?>
                              <p class="text-sm mb-0">Status:
                              <a href="max_bidder.php?user_Id=<?php echo $nameofmaxbidder; ?>" type="button">Someone has higher bidder </a>
                              <?php if($bid_due_date > $date_today) { ?>
                                <form action="process_update.php" method="POST">
                                  <div class="input-group">
                                    <input type="hidden" class="form-control form-control-sm" name="user_Id" value="<?php echo $id; ?>">
                                    <input type="hidden" class="form-control form-control-sm" name="product_Id" value="<?php echo $productId; ?>" id="product_Id_<?php echo $productId; ?>">
                                    <input type="number" class="form-control form-control-sm" placeholder="Enter bidding price..." id="bidInput_<?php echo $productId; ?>" name="bidding_price">
                                    <div class="input-group-append">
                                      <button class="btn btn-primary btn-sm" type="submit" name="update_bidding">
                                        <i class="fa-solid fa-paper-plane"></i>
                                      </button>
                                    </div>
                                  </div>
                                </form>
                                <span id="errorMessage_<?php echo $productId; ?>" style="display: none;" class="font-italic text-xs text-danger text-bold"></span>
                              <?php } ?>
                              </p>
                            <?php else: ?>
                              <p class="text-sm mb-0">Status:
                              <a href="max_bidder.php?user_Id=<?php echo $nameofmaxbidder; ?>" type="button">You are the lowest bidder </a>
                              <?php if($bid_due_date > $date_today) { ?>
                                <form action="process_update.php" method="POST">
                                  <div class="input-group">
                                    <input type="hidden" class="form-control form-control-sm" name="user_Id" value="<?php echo $id; ?>">
                                    <input type="hidden" class="form-control form-control-sm" name="product_Id" value="<?php echo $productId; ?>" id="product_Id_<?php echo $productId; ?>">
                                    <input type="number" class="form-control form-control-sm" placeholder="Enter bidding price..." id="bidInput_<?php echo $productId; ?>" name="bidding_price">
                                    <div class="input-group-append">
                                      <button class="btn btn-primary btn-sm" type="submit" name="update_bidding">
                                        <i class="fa-solid fa-paper-plane"></i>
                                      </button>
                                    </div>
                                  </div>
                                </form>
                                <span id="errorMessage_<?php echo $productId; ?>" style="display: none;" class="font-italic text-xs text-danger text-bold"></span>
                              <?php } ?>
                              </p>
                            <?php endif; ?>
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

                            // // Get the value of the input element with an id of "product_Id"
                            // var productId = document.getElementById("product_Id_<?php echo $productId; ?>").value = <?php echo $productId; ?>;
                            // // Post the productId using AJAX
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

          <?php } //END OF WHILE LOOP ?>  

                <div class="col-12 text-center mt-3">
                  <p>You have reached the end of the list</p>
                  <hr>
                </div>  
                
          <?php  } /*END OF IF MYSQLI_NUM_ROWS > 0*/
          else { ?>

              <div class="text-center d-block m-auto">
                <img src="../images/hack-khaby.gif" alt="No results found" class="img-fluid" width="250">
                <p class="mt-2">No record found.</p>
              </div>

          <?php } } //END SEARCH  ?>

        </div>
      </div>
    </div>
  </div>


  
<?php include 'footer.php'; ?>

<script>
// Loop through each input element
<?php mysqli_data_seek($fetch, 0); // Reset the data pointer to the beginning of the array ?>
<?php while ($row = mysqli_fetch_array($fetch)) { ?>
  const bidInput_<?php echo $row['product_Id']; ?> = document.getElementById("bidInput_<?php echo $row['product_Id']; ?>");
  const errorMessage_<?php echo $row['product_Id']; ?> = document.getElementById("errorMessage_<?php echo $row['product_Id']; ?>");

  bidInput_<?php echo $row['product_Id']; ?>.addEventListener("input", function() {
    const myValue_<?php echo $row['product_Id']; ?> = <?php echo $row['starting_price']; ?>;
    const bidPrice_<?php echo $row['product_Id']; ?> = Number(bidInput_<?php echo $row['product_Id']; ?>.value);

    if (bidPrice_<?php echo $row['product_Id']; ?> < myValue_<?php echo $row['product_Id']; ?>) {
      errorMessage_<?php echo $row['product_Id']; ?>.textContent = "Bidding price must be equal or higher than the starting price(₱" + Number(myValue_<?php echo $row['product_Id']; ?>).toLocaleString('en-US', { minimumFractionDigits: 2 }) + ")";
      errorMessage_<?php echo $row['product_Id']; ?>.style.display = "block";
    } else {
      errorMessage_<?php echo $row['product_Id']; ?>.style.display = "none";
    }
  });
<?php } ?>
</script>

