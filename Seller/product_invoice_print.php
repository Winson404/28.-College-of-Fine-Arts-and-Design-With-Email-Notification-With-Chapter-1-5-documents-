<?php 
    include '../config.php';
    if(isset($_GET['user_Id']))
    $id = $_GET['user_Id'];
    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$id'");
    $row = mysqli_fetch_array($fetch);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SC E-commerce | Invoice Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body>

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> E-commerce
          <small class="float-right"><?php echo date("M d, Y"); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Admin, Inc.</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong><?php echo ' '.$row['fname'].' '.$row['mname'].' '.$row['lname'].' '.$row['suffix'].' '; ?></strong><br>
          <!-- 795 Folsom Ave, Suite 600<br> -->
          <?php echo $row['address']; ?><br>
          Phone: <?php echo $row['contact']; ?><br>
          Email: <?php echo $row['email']; ?>
        </address>
      </div>
      <!-- /.col -->
      <!-- <div class="col-sm-4 invoice-col">
        <b>Invoice #007612</b><br>
        <br>
        <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567
      </div> -->
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Product name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
             <?php 

                // FETCH GRAND TOTAL ************************************************************************************************************
                              $fetch_total = mysqli_query($conn, "SELECT SUM(cart_total) AS total_price FROM cart JOIN users ON cart.cart_user_Id=users.user_Id WHERE cart_user_Id='$id' AND cart_status='Confirmed' AND checkout='Confirmed'");
                              $row_total = mysqli_fetch_array($fetch_total);

                              $price = $row_total['total_price'];
                              $grand_price = $price;
                              $grand_price_text = (string)$grand_price; // convert into a string
                              $grand_price_text = strrev($grand_price_text); // reverse string
                              $arr = str_split($grand_price_text, "3"); // break string in 3 character sets

                              $grand_price_new_text = implode(",", $arr);  // implode array with comma
                              $grand_price_new_text = strrev($grand_price_new_text); // reverse string back
                              //echo $grand_price_new_text; // will output 1,234
                              //
                              // END FETCH GRAND TOTAL ********************************************************************************************************
                           

                $a = mysqli_query($conn, "SELECT * FROM cart JOIN users ON cart.cart_user_Id=users.user_Id JOIN product ON cart.cart_product_Id=product.product_Id WHERE cart_user_Id='$id' AND cart_status='Confirmed' AND checkout='Confirmed'");
                while ($b = mysqli_fetch_array($a)) {

                // TO ADD COMMA FOR PRICE
                              $price = $b['product_price'];
                              $price_text = (string)$price; // convert into a string
                              $price_text = strrev($price_text); // reverse string
                              $arr = str_split($price_text, "3"); // break string in 3 character sets

                              $price_new_text = implode(",", $arr);  // implode array with comma
                              $price_new_text = strrev($price_new_text); // reverse string back
                              //echo $price_new_text; // will output 1,234
                              



                              $qty = $b['cart_quantity'];
                              $total = $price * $qty;

                              // TO ADD COMMA FOR PRICE
                              $total_price = $total;
                              $price_texts = (string)$total_price; // convert into a string
                              $price_texts = strrev($price_texts); // reverse string
                              $arrs = str_split($price_texts, "3"); // break string in 3 character sets

                              $price_new_texts = implode(",", $arrs);  // implode array with comma
                              $price_new_texts = strrev($price_new_texts); // reverse string back
                              //echo $price_new_text; // will output 1,234
              ?>
           <tr>
              <td><?php echo $b['cart_quantity']; ?></td>
              <td><?php echo $b['product_name']; ?></td>
              <td><?php echo $b['product_description']; ?></td>
              <td>₱ <?php echo $price_new_text; ?>.00</td>
              <td>₱ <?php echo $price_new_texts; ?>.00</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
       <div class="col-6">
          <p class="lead">Payment Methods: <b>COD</b></p>
          <!-- <img src="../dist/img/credit/visa.png" alt="Visa">
          <img src="../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../dist/img/credit/american-express.png" alt="American Express">
          <img src="../dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
            plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p> -->
        </div>
      <!-- /.col -->
      <div class="col-6">
        <!-- <p class="lead">Amount Due 2/22/2014</p> -->

        <div class="table-responsive">
          <table class="table">
            <!-- <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr> -->
            <tr>
              <th>Total:</th>
              <td>₱ <?php echo $grand_price_new_text; ?>.00</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
