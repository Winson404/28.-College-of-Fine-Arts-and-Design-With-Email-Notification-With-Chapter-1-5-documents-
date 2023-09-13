<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['bidding_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
     <div class="modal-header bg-light">
      <h5 class="modal-title" id="exampleModalLabel"> Delete Bidded Product</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
      </button>
    </div>
    <div class="modal-body">
      <form action="process_delete.php" method="POST">
        <input type="hidden" class="form-control" value="<?php echo $row['bidding_Id']; ?>" name="bidding_Id">
        <h6 class="text-center">Delete bidded product record?</h6>
    </div>
    <div class="modal-footer alert-light">
      <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
      <button type="submit" class="btn bg-danger" name="delete_Bidding"><i class="fas fa-trash"></i> Delete</button>
    </div>
      </form>
  </div>
</div>



  