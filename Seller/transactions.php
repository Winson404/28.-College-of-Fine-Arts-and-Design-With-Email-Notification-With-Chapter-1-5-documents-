<?php 
    include 'navbar.php'; 
?>
<title><?php echo $settings_name; ?> | Winners information</title>
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
            <h1 class="m-0"> Winners </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Winners info</li>
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
                      <th>PRODUCT NAME</th>
                      <th>PRICE</th>
                      <th>BID DUE DATE</th>
                      <th>BIDDER'S NAME</th>
                      <th>PAYMENT RECEIPT</th>
                      <th>STATUS</th>
                      <th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        $i = 1;
                        // $fetch = mysqli_query($conn, "SELECT * FROM bidding JOIN product ON bidding.product_Id=product.product_Id JOIN users ON bidding.user_Id=users.user_Id WHERE product.user_Id='$id' AND product.product_status=1 ORDER BY product.bid_due_date ASC ");
                        $fetch = mysqli_query($conn, "SELECT * FROM bidding_winner JOIN product ON bidding_winner.product_Id=product.product_Id JOIN users ON bidding_winner.user_Id=users.user_Id JOIN bidding ON bidding_winner.product_Id=bidding.product_Id WHERE product.user_Id='$id' AND product.product_status=1 AND bidding.bidding_status=1 GROUP BY bidding.product_Id ORDER BY product.bid_due_date ASC ");
                        while ($row = mysqli_fetch_array($fetch)) {
                      ?>
                      <tr>
                        <td class="text-center">
                            <a data-toggle="modal" data-target="#viewphoto<?php echo $row['product_Id']; ?>">
                              <img src="../images-product/<?php echo $row['product_image']; ?>" alt="" width="40" height="40" class="img-circle d-block m-auto">
                            </a href="">
                        </td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td class="text-bold">₱ <?php echo number_format($row['starting_price'], 2, '.', ','); ?></td>
                        <td><?php echo date("F d, Y", strtotime($row['bid_due_date'])); ?></td>
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td>
                          <?php if(empty($row['payment_proof'])): ?>
                            <span class="badge bg-danger pt-1">Unavailable</span>
                          <?php else: ?>
                            <span class="badge badge-success pt-1">Available</span>
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
                            <a class="btn btn-primary btn-xs" href="users_view.php?user_Id=<?php echo $row['user_Id']; ?>"><i class="fa-solid fa-eye"></i> Bidder's info</a>
                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#view<?php echo $row['bidding_Id']; ?>"><i class="fa-solid fa-money-bill"></i> Receipt </button>                                                  
                        </td> 
                    </tr>
                    <?php include 'transactions_view.php'; } ?>
                  </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  
<?php include 'footer.php'; ?>




