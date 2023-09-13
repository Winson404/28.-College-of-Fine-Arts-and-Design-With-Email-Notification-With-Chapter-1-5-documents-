<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['product_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-bag-shopping"></i> Delete product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['product_Id']; ?>" name="product_Id">
          <h6 class="text-center">Delete record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-danger btn-sm" name="delete_product"><i class="fas fa-trash"></i> Confirm</button>
      </div>
        </form>
    </div>
  </div>
</div>

