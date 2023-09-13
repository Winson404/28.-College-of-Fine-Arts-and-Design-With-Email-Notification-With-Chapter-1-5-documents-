<?php 
    include 'navbar.php'; 
    if(isset($_GET['bidding_Id'])) {
      $bidding_Id = $_GET['bidding_Id'];
?>
<title><?php echo $settings_name; ?> | Proof of payment</title>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Payment </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Payment info</li>
            </ol>
          </div>
        </div>
      </div>
    </div>


    <!-- Main content -->
    <div class="content">
      <div class="container card  p-5">
        <div class="row d-flex justify-content-center p-5">
            <!-- LOAD IMAGE PREVIEW -->
            <div class="col-lg-6 col-md-4 col-sm-6 col-12">
                <div class="form-group" id="user_preview">
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-6 col-12">
              <form action="process_update.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" class="form-control" name="bidding_Id" value="<?php echo $bidding_Id; ?>">

                <div class="form-group">
                  <span class="text-dark"><b>Proof of payment(receipt) </b></span>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload" onchange="newgetImagePreview(event)" required>
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>

                  </div>
                  <p class="help-block text-danger">Max. 500KB</p>
                </div>

                <button class="btn btn-primary float-right" type="submit" name="Proofpayment">Submit</button>
            </div>
           
            </form> 
          
        </div>
      </div>
    </div>
  </div>


  
<?php } else { include '404.php'; }  include 'footer.php'; ?>




