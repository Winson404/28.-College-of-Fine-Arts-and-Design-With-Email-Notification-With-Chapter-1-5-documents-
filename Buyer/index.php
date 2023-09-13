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
            <h1 class="m-0"> All Products</h1>
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
              $fetch = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.product_cat_Id=category.cat_id WHERE product.product_status=0 AND product.bid_due_date >= '$date_today' AND product.product_name LIKE '%$search_product%'");
              if(mysqli_num_rows($fetch) > 0) {
                while ($row = mysqli_fetch_array($fetch)) {
                  $productId = $row['product_Id'];
                  $countdownId = "countdown-" . $productId;
                  $bid_due_date = $row['bid_due_date'];
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
                          <form action="process_save.php" method="POST">
                            <div class="input-group">
                              <input type="hidden" class="form-control form-control-sm" name="user_Id" value="<?php echo $id; ?>">
                              <input type="hidden" class="form-control form-control-sm" name="product_Id" value="<?php echo $productId; ?>" id="product_Id_<?php echo $productId; ?>">
                              <input type="number" class="form-control form-control-sm" placeholder="Enter bidding price..." id="bidInput_<?php echo $productId; ?>" name="bidding_price">
                              <div class="input-group-append">
                                <button class="btn btn-primary btn-sm" type="submit" name="add_bidding">
                                  <i class="fa-solid fa-paper-plane"></i>
                                </button>
                              </div>
                            </div>
                          </form>
                          <span id="errorMessage_<?php echo $productId; ?>" style="display: none;" class="font-italic text-xs text-danger text-bold"></span>
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
         
            $fetch = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.product_cat_Id=category.cat_id WHERE product.product_status=0 AND product.bid_due_date > '$date_today' ORDER BY RAND()");
              if(mysqli_num_rows($fetch) > 0) {
                while ($row = mysqli_fetch_array($fetch)) {
                  $productId = $row['product_Id'];
                  $countdownId = "countdown-" . $productId;
                  $bid_due_date = $row['bid_due_date'];
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
                          <form action="process_save.php" method="POST">
                            <div class="input-group">
                              <input type="hidden" class="form-control form-control-sm" name="user_Id" value="<?php echo $id; ?>">
                              <input type="hidden" class="form-control form-control-sm" name="product_Id" value="<?php echo $productId; ?>" id="product_Id_<?php echo $productId; ?>">
                              <input type="number" class="form-control form-control-sm" placeholder="Enter bidding price..." id="bidInput_<?php echo $productId; ?>" name="bidding_price">
                              <div class="input-group-append">
                                <button class="btn btn-primary btn-sm" type="submit" name="add_bidding">
                                  <i class="fa-solid fa-paper-plane"></i>
                                </button>
                              </div>
                            </div>
                          </form>
                          <span id="errorMessage_<?php echo $productId; ?>" style="display: none;" class="font-italic text-xs text-danger text-bold"></span>
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

          <?php } ?>
          <!-- <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div> -->

        <?php } //END SEARCH  ?>

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

