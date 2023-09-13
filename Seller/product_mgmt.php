<?php 
    include 'navbar.php'; 
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
?>
<title><?php echo $settings_name; ?> | Product info</title>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



<?php if($page === 'create') { ?>

    <!-- CREATION -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>New Product</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Product info</li>
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
            <form action="process_save.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="user_Id" value="<?php echo $id; ?>">
              <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">  
                      <div class="col-lg-12 mt-1 mb-2">
                        <a class="h5 text-primary"><b>Product information</b></a>
                        <div class="dropdown-divider"></div>
                      </div>                
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="form-group">
                            <b>Category name</b>
                            <select class="form-control" name="product_cat_Id" required>
                              <option selected disabled>Select category</option>
                              <?php 
                                $fetch = mysqli_query($conn, "SELECT * FROM category");
                                while ($row = mysqli_fetch_array($fetch)) {
                              ?>
                              <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <b>Product name</b>
                            <input type="text" class="form-control"  placeholder="Product name" name="product_name" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                            <b>Product description</b>
                            <textarea id="" cols="30" rows="2" class="form-control"  placeholder="Product description" name="product_desc" required></textarea>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <b>Starting Price</b>
                            <input type="number" class="form-control"  placeholder="Starting Price" name="starting_price" required>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <b>Bid Due Date</b>
                            <input type="date" class="form-control"  placeholder="Bid Due Date" name="bid_due_date" required>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                          <span class="text-dark"><b>Product image</b></span>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload" onchange="getImagePreview(event)" required>
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>


                          </div>
                          <p class="help-block text-danger">Max. 500KB</p>
                        </div>
                      </div>
                      <!-- LOAD IMAGE PREVIEW -->
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="form-group" id="preview">
                          </div>
                      </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <a href="product.php" class="btn bg-secondary"><i class="fa-solid fa-backward"></i> Back to list</a>
                    <button type="submit" class="btn bg-primary" name="create_product" id="create_admin"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  <!-- END CREATION -->





<?php } else { 
  $product_Id = $page;
  $fetch = mysqli_query($conn, "SELECT * FROM product WHERE product_Id='$product_Id'");
  $prod_row = mysqli_fetch_array($fetch);

  // Assuming $prod_row['bid_due_date'] contains the datetime value from the database
  $mysqlDatetime = $prod_row['bid_due_date'];

  // Convert the MySQL datetime string to a Unix timestamp
  $timestamp = strtotime($mysqlDatetime);

  // Convert the Unix timestamp to a date string in the correct format for the input element
  $dateString = date('Y-m-d', $timestamp);

?>


  <!-- UPDATE -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3>Update Product</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Product info</li>
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
          <form action="process_update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="product_Id" required value="<?php echo $prod_row['product_Id']; ?>">
            <div class="card">
              <div class="card-body">
                  <div class="row d-flex justify-content-center">  
                      <div class="col-lg-12 mt-1 mb-2">
                        <a class="h5 text-primary"><b>Product information</b></a>
                        <div class="dropdown-divider"></div>
                      </div>                
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="form-group">
                            <b>Category name</b>
                            <select class="form-control" name="product_cat_Id" required>
                              <option selected disabled>Select category</option>
                              <?php 
                                $pro_cat_Id = $prod_row['product_cat_Id'];
                                $fetch = mysqli_query($conn, "SELECT * FROM category");
                                while ($row = mysqli_fetch_array($fetch)) {
                              ?>
                              <option value="<?php echo $row['cat_id']; ?>" <?php if($row['cat_id'] == $pro_cat_Id) { echo 'selected'; } ?>><?php echo $row['cat_name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <b>Product name</b>
                            <input type="text" class="form-control"  placeholder="Product name" name="product_name" required value="<?php echo $prod_row['product_name']; ?>">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                            <b>Product description</b>
                            <textarea id="" cols="30" rows="2" class="form-control"  placeholder="Product description" name="product_desc" required><?php echo $prod_row['product_desc']; ?></textarea>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <b>Starting Price</b>
                            <input type="number" class="form-control"  placeholder="Starting Price" name="starting_price" required value="<?php echo $prod_row['starting_price']; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                            <b>Bid Due Date</b>
                            <input type="date" class="form-control"  placeholder="Bid Due Date" name="bid_due_date" required value="<?php echo $dateString; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group">
                          <span class="text-dark"><b>Product image</b></span>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload" onchange="getImagePreview(event)">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>

                          </div>
                          <p class="help-block text-danger">Max. 500KB</p>
                        </div>
                      </div>
                      <!-- LOAD IMAGE PREVIEW -->
                      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="form-group" id="preview">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card-footer">
                <div class="float-right">
                  <a href="product.php" class="btn bg-secondary"><i class="fa-solid fa-backward"></i> Back to list</a>
                  <button type="submit" class="btn bg-primary" name="update_product" id="create_admin"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- END UPDATE -->


<?php } ?>


  </div>

<?php } else { include '404.php'; } ?>


<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'footer.php';  ?>

