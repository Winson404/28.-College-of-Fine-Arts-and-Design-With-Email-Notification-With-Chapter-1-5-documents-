<!-- DELETE -->
<div class="modal fade" id="view<?php echo $row['bidding_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog ">
  <div class="modal-content">
     <div class="modal-header bg-light">
      <?php if($row['payment'] == 1): ?>
        <h5 class="modal-title" id="exampleModalLabel"> Confirm payment</h5>
      <?php elseif($row['payment'] == 2): ?>
        <h5 class="modal-title" id="exampleModalLabel"> Receipt payment</h5>
      <?php else: ?>
        <h5 class="modal-title" id="exampleModalLabel"> Receipt unavailable</h5>
      <?php endif; ?>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
      </button>
    </div>
    <div class="modal-body">
      <?php if($row['payment'] == 1): ?>
        <img src="../images-payments/<?php echo $row['payment_proof'] ?>" alt="" class="img-fluid d-block m-auto" width="300">
          <div class=" d-block m-auto text-center mt-4">
            <a href="../images-payments/<?php echo $row['payment_proof'] ?>" type="button" class="btn bg-gradient-primary btn-xs" download><i class="fa-solid fa-download"></i> Download</a>
          </div>
          <hr>
          <form action="process_update.php" method="POST">
            <input type="hidden" class="form-control" value="<?php echo $row['bidding_Id']; ?>" name="bidding_Id">
            <h6 class="text-center">Confirm bidder's payment?</h6>
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
          <button type="submit" class="btn bg-primary" name="confirm_Bidding"><i class="fa-solid fa-floppy-disk"></i> Confirm</button>
        </div>
          </form>
      <?php elseif($row['payment'] == 2): ?>
        <img src="../images-payments/<?php echo $row['payment_proof'] ?>" alt="" class="img-fluid d-block m-auto" width="300">
          <div class=" d-block m-auto text-center mt-4">
            <a href="../images-payments/<?php echo $row['payment_proof'] ?>" type="button" class="btn bg-gradient-primary btn-xs" download><i class="fa-solid fa-download"></i> Download</a>
          </div>
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        </div>
      <?php else: ?>
            <h6 class="text-center">Receipt unavailable</h6>
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Close</button>
        </div>
      <?php endif; ?>
      
  </div>
</div>



  