<?php 
    include 'navbar.php'; 
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
            <h1 class="m-0"> Products biddings </h1>
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
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                    <tr>
                      <th>IMAGE PRODUCT</th>
                      <th>CATEGORY NAME</th>
                      <th>PRODUCT NAME</th>
                      <th>PRICE</th>
                      <th>BID DUE DATE</th>
                      <th>WINNER/LOSS</th>
                      <th>STATUS</th>
                      <th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        $i = 1;
                        $fetch = mysqli_query($conn, "SELECT * FROM bidding JOIN product ON bidding.product_Id=product.product_Id JOIN category ON product.product_cat_Id=category.cat_id WHERE bidding.user_Id='$id'  ORDER BY product.bid_due_date ASC ");
                        while ($row = mysqli_fetch_array($fetch)) {
                          $productId = $row['product_Id'];
                          $countdownId = "countdown-" . $productId;
                          $bid_due_date = $row['bid_due_date'];
                      ?>
                      <tr>
                        <td class="text-center">
                            <a data-toggle="modal" data-target="#viewphoto<?php echo $row['product_Id']; ?>">
                              <img src="../images-product/<?php echo $row['product_image']; ?>" alt="" width="40" height="40" class="img-circle d-block m-auto">
                            </a href="">
                        </td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td class="text-bold">₱ <?php echo number_format($row['starting_price'], 2, '.', ','); ?></td>
                        <td><?php echo date("F d, Y", strtotime($row['bid_due_date'])); ?></td>
                         <td>
                          <?php if($row['bidding_status'] == 0): ?>
                            <span class="badge bg-info pt-1">Have Bidded</span>
                          <?php elseif($row['bidding_status'] == 1): ?>
                            <span class="badge bg-success pt-1">Win</span>
                          <?php else: ?>
                            <span class="badge badge-danger pt-1">Loss</span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if($row['payment'] == 0): ?>
                            <span class="badge bg-danger pt-1">Pending / Unpaid</span>
                          <?php elseif($row['payment'] == 1): ?>
                            <span class="badge bg-info pt-1">Payment unconfirmed</span>
                          <?php else: ?>
                            <span class="badge badge-success pt-1">Payment confirmed</span>
                          <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="product_view.php?product_Id=<?php echo $row['product_Id']; ?>"><i class="fas fa-folder"></i> </a>

                            <?php if($row['bidding_status'] != 1): ?>
                              <a class="btn btn-info btn-xs" href="payment.php?bidding_Id=<?php echo $row['bidding_Id']; ?>" style="pointer-events: none;opacity: .5;"><i class="fa-solid fa-money-bill"></i> </a>
                            <?php else: ?>
                              <a class="btn btn-info btn-xs" href="payment.php?bidding_Id=<?php echo $row['bidding_Id']; ?>"><i class="fa-solid fa-money-bill"></i> </a>
                            <?php endif; ?>

                            
                            
                            <?php if($row['product_status'] == 0): ?>
                              <button type="button" class="btn bg-danger btn-xs" data-toggle="modal" data-target="#delete<?php echo $row['bidding_Id']; ?>"><i class="fa-solid fa-trash-can"></i> </button>
                            <?php else: ?>
                              <button type="button" class="btn bg-danger btn-xs" data-toggle="modal" data-target="#delete<?php echo $row['bidding_Id']; ?>" disabled><i class="fa-solid fa-trash-can"></i> </button>
                            <?php endif; ?>
                        </td> 
                    </tr>
                    <?php include 'transactions_delete.php'; } ?>
                  </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  
<?php include 'footer.php'; ?>




