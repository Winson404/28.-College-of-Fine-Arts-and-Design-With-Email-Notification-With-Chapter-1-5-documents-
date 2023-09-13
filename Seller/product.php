<?php include 'navbar.php'; ?>
<title><?php echo $settings_name; ?> | Product records</title>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
                <a href="product_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> Post product</a>

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
                    <th>IMAGE</th>
                    <th>CATEGORY NAME</th>
                    <th>PRODUCT NAME</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>BID DUE DATE</th>
                    <th>WINNER</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM product JOIN category ON product.product_cat_Id=category.cat_id JOIN users ON product.user_Id=users.user_Id WHERE product.user_Id='$id'");
                        while ($row = mysqli_fetch_array($sql)) {

                          $pro_Id = $row['product_Id'];

                          // GET WINNER INFO
                          $win = mysqli_query($conn, "SELECT * FROM bidding_winner JOIN bidding ON bidding_winner.product_Id=bidding.product_Id JOIN users ON bidding_winner.user_Id=users.user_Id WHERE bidding_winner.product_Id='$pro_Id' AND bidding.bidding_status=1 GROUP BY bidding_winner.product_Id");
                          // $winnerId = mysqli_fetch_array($);
                      ?>
                      <tr>
                        <td class="text-center">
                            <a data-toggle="modal" data-target="#viewphoto<?php echo $row['product_Id']; ?>">
                              <img src="../images-product/<?php echo $row['product_image']; ?>" alt="" width="40" height="40" class="img-circle d-block m-auto">
                            </a>
                        </td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo custom_echo($row['product_desc'], 30); ?></td>
                        <td class="text-bold">₱ <?php echo number_format($row['starting_price'], 2, '.', ','); ?></td>
                        <td><?php echo date("F d, Y", strtotime($row['bid_due_date'])); ?></td>
                        <td>
                          <?php 
                            $winrow_Id = null; // Initialize the variable
                            if(mysqli_num_rows($win) > 0) {
                              while ($win_row = mysqli_fetch_array($win)) {
                                echo $win_row['firstname'].' '.$win_row['middlename'].' '.$win_row['lastname'].' '.$win_row['suffix'];
                                $winrow_Id = $win_row['user_Id'];
                              }
                            } else {
                              
                            }
                          ?>
                        </td>
                        <td>
                          <?php if($row['product_status'] == 0): ?>
                            <span class="badge bg-info pt-1">Available</span>
                          <?php else: ?>
                            <span class="badge bg-danger pt-1">Sold</span>
                          <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="product_view.php?product_Id=<?php echo $row['product_Id']; ?>" title="View product"><i class="fa-solid fa-eye"></i> </a>
                            <?php if($winrow_Id !== null) { ?>
                               <a class="btn btn-warning btn-xs" href="users_view.php?user_Id=<?php echo $winrow_Id; ?>" title="View winner"><i class="fa-solid fa-user"></i></a>
                            <?php } else { ?>
                                <a class="btn btn-warning btn-xs" href="#" style="pointer-events: none;opacity: .8;" title="View winner"><i class="fa-solid fa-user"></i></a>
                            <?php } ?>
                            <a class="btn btn-info btn-xs" href="product_mgmt.php?page=<?php echo $row['product_Id']; ?>" title="Edit product"><i class="fas fa-pencil-alt"></i> </a>
                            <button type="button" class="btn bg-danger btn-xs" data-toggle="modal" data-target="#delete<?php echo $row['product_Id']; ?>" title="Delete product"><i class="fa-solid fa-trash-can"></i> </button>
                        </td> 
                    </tr>
                    <?php include 'product_delete.php'; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

 <?php include 'footer.php'; ?>

