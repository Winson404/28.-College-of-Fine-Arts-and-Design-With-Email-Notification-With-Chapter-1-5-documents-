<!-- UDPATE -->
<div class="modal fade" id="update<?php echo $row['cat_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Update category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control form-control-sm" value="<?php echo $row['cat_id']; ?>" name="cat_id">
          <div class="form-group">
            <label>Product category</label>
            <input type="text" class="form-control"  placeholder="Enter book category name..." name="category"  value="<?php echo $row['cat_name']; ?>" required>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary btn-sm" name="update_category"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['cat_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Delete category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
  
      <div class="modal-body">
        <form action="process_delete.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control form-control-sm" value="<?php echo $row['cat_id']; ?>" name="cat_id">
          <h6 class="text-center">Delete category?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger btn-sm" name="delete_category"><i class="fa-solid fa-trash-can"></i> Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>


