<?php include 'navbar.php'; ?>
<title><?php echo $settings_name; ?> | Product buyers records</title>
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
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Product buyers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Product buyers</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <div class="card-tools mr-1 mt-1">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">

                <div class="row d-flex justify-content-center">
                  <?php 
                    $get_Id = "";
                    if(isset($_GET['product_Id'])) {
                        $get_Id = $_GET['product_Id'];
                        $fetch = mysqli_query($conn, "SELECT *, COUNT(bidding_Id) as num_bids FROM bidding JOIN product ON bidding.product_Id=product.product_Id JOIN category ON product.product_cat_Id=category.cat_id WHERE product.user_Id='$id' AND product.product_Id='$get_Id' GROUP BY bidding.product_Id ORDER BY bidding.bidding_price DESC ");
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

                   <div class="col-lg-4 col-12">
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

              <?php } } ?>


                  <div class="col-lg-8">
                     <table id="example1" class="table table-sm table-bordered table-hover text-sm">
                  <thead>
                    <tr>
                      <th>BUYER</th>
                      <th>BIDDING PRICE</th>
                      <th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        if(isset($_GET['product_Id'])) {
                          $getproduct_Id = $_GET['product_Id'];
                          $i = 1;

                          $sql = mysqli_query($conn, "
                            SELECT *
                            FROM bidding
                            JOIN users ON bidding.user_Id = users.user_Id
                            JOIN (
                                SELECT user_Id, MAX(bidding_price) AS max_price
                                FROM bidding
                                WHERE product_Id = '$getproduct_Id'
                                GROUP BY user_Id
                            ) AS max_bids ON bidding.user_Id = max_bids.user_Id
                            WHERE bidding.product_Id = '$getproduct_Id'
                            AND bidding.bidding_price = max_bids.max_price
                            ORDER BY bidding.bidding_price DESC
                        ");




                          while ($row = mysqli_fetch_array($sql)) {

                      ?>
                      <tr>
                        <td>
                          <?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'];?>
                        </td>
                        <td class="text-bold">₱ <?php echo number_format($row['bidding_price'], 2, '.', ','); ?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="users_view.php?user_Id=<?php echo $row['user_Id']; ?>"><i class="fas fa-folder"></i> Buyer's info</a>
                        </td> 
                    </tr>
                    <?php include 'product_delete.php'; } } ?>
                  </tbody>
                </table>
                <hr>
                <h5 class="mb-0 text-center"><a href="product_bidding_history.php?product_Id=<?php echo $get_Id; ?>"> Bidding history</a></h5>

                <div class="bg-gray py-1 px-3 mt-2"></div>
                <div>
                  <a onclick="window.history.back()" class="float-right btn btn-secondary btn-sm mt-2"><i class="fa-solid fa-backward"></i> Back</a>
                </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
 <?php include 'footer.php'; ?>

