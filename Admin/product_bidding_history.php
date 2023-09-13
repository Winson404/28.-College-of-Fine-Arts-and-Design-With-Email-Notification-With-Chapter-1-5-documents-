<?php include 'navbar.php'; ?>
<title><?php echo $settings_name; ?> | Product Bidding History</title>
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
            <h1>Product Bidding History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Product Bidding History</li>
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

                  


                 <table id="example1" class="table table-sm table-bordered table-hover text-sm">
                  <thead>
                    <tr>
                      <th>BUYER</th>
                      <th>BIDDING PRICE</th>
                      <th>BIDDING DATE</th>
                    </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        if(isset($_GET['product_Id'])) {
                          $getproduct_Id = $_GET['product_Id'];
                          $i = 1;

                          $sql = mysqli_query($conn, "SELECT * FROM bidding JOIN users ON bidding.user_Id=users.user_Id WHERE bidding.product_Id='$getproduct_Id' ORDER BY bidding_Id DESC");
                          while ($row = mysqli_fetch_array($sql)) {

                      ?>
                      <tr>
                        <td>
                          <?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'];?>
                        </td>
                        <td class="text-bold">₱ <?php echo number_format($row['bidding_price'], 2, '.', ','); ?></td>
                        <td><?php echo date("F d, Y h:i A", strtotime($row['date_added'])); ?></td>
                       
                    </tr>
                    <?php include 'product_delete.php'; } } ?>
                  </tbody>
                </table>
                <hr>
                <div class="bg-gray py-1 px-3 mt-2"></div>
                <div>
                  <a onclick="window.history.back()" class="float-right btn btn-secondary btn-sm mt-2"><i class="fa-solid fa-backward"></i> Back</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

 <?php include 'footer.php'; ?>

