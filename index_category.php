<?php 
    include 'navbar.php'; 
    if(isset($_GET['category_Id'])) {

      $category_Id = $_GET['category_Id'];
      $count = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.product_cat_Id=category.cat_id WHERE product.product_status=0 AND product.bid_due_date >= '$date_today' AND product.product_cat_Id='$category_Id'");
      $count_pro = mysqli_num_rows($count);

      $c_name = mysqli_query($conn, "SELECT * FROM category WHERE cat_id='$category_Id'");
      $cat_name = mysqli_fetch_array($c_name);

?>
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
            <h1 class="m-0"> <?php echo ucwords($cat_name['cat_name']); ?> category </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><?php echo ucwords($cat_name['cat_name']); ?> products</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <p class="text-muted"><?php echo $count_pro; ?> total products</p>
        <div class="row d-flex justify-content-start">

          <?php 
            if(isset($_POST['search_button'])) {
              $search_product = mysqli_real_escape_string($conn, $_POST['search_product']);
              $fetch = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.product_cat_Id=category.cat_id WHERE product.product_status=0 AND product.bid_due_date >= '$date_today' AND product.product_cat_Id='$category_Id' AND product.product_name LIKE '%$search_product%'");

              if(mysqli_num_rows($fetch) > 0) {
                while ($row = mysqli_fetch_array($fetch)) {
                  $productId = $row['product_Id'];
                  $countdownId = "countdown-" . $productId;
                  $bid_due_date = $row['bid_due_date'];
          ?>

               <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                  <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                    </div>
                    <a href="product_view.php?product_Id=<?php echo $productId; ?>">
                      <div class="card-body" style="margin-bottom: -30px;">
                        <div class="img">
                          <img src="images-product/<?php echo $row['product_image']; ?>" alt="" class="img-fluid product-image">
                        </div>
                        <p>
                          <?php echo ucwords($row['product_name']); ?><br>
                          <span class="text-sm text-danger">₱<?php echo number_format($row['starting_price'], 2, '.', ','); ?></span> <br>
                          <img src="images/hourglass.gif" alt="" width="20"> <span class="text-xs text-muted" id="countdown_<?php echo $productId; ?>"></span>
                        </p>
                      </div>
                    </a>
                    <div class="card-footer">
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

              <div class="col-12 text-center d-block m-auto">
                <hr>
                <!-- <img src="images/hack-khaby.gif" alt="No results found" class="img-fluid" width="250"> -->
                <p class="mt-2">No record found.</p>
              </div>

          <?php } } else { ?>
          <?php
            $fetch = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.product_cat_Id=category.cat_id WHERE product.product_status=0 AND product.bid_due_date >= '$date_today' AND product.product_cat_Id='$category_Id' ORDER BY RAND()");
              if(mysqli_num_rows($fetch) > 0) {
                while ($row = mysqli_fetch_array($fetch)) {
                  $productId = $row['product_Id'];
                  $countdownId = "countdown-" . $productId;
                  $bid_due_date = $row['bid_due_date'];

          ?>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                      <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                        </div>
                        <a href="product_view.php?product_Id=<?php echo $productId; ?>">
                          <div class="card-body" style="margin-bottom: -30px;">
                            <div class="img">
                              <img src="images-product/<?php echo $row['product_image']; ?>" alt="" class="img-fluid product-image">
                            </div>
                            <p>
                              <?php echo ucwords($row['product_name']); ?><br>
                              <span class="text-sm text-danger">₱<?php echo number_format($row['starting_price'], 2, '.', ','); ?></span> <br>
                              <img src="images/hourglass.gif" alt="" width="20"> <span class="text-xs text-muted" id="countdown_<?php echo $productId; ?>"></span>
                            </p>
                          </div>
                        </a>
                        <div class="card-footer">
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
            
              <div class="col-12 text-center d-block m-auto">
                <hr>
                <!-- <img src="images/hack-khaby.gif" alt="No results found" class="img-fluid" width="250"> -->
                <p class="mt-2">No record found.</p>
              </div>
          <?php } } //END SEARCH  ?>
        </div>
      </div>
    </div>
  </div>


  
<?php include 'footer.php'; ?>

<?php } else { include '404.php'; } ?>

