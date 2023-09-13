<!-- VIEW SETTINGS -->
<div class="modal fade" id="view<?php echo $row['customID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-gear"></i> Website settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">

            <h5 class="text-center text-bold"><?php if(!empty($row['brandName'])) { echo $row['brandName']; } else { echo 'Website/Brand Name Unavailable'; }; ?></h5>
            <hr>
            <h6> 
              <b>About:</b> <br> 
              <p class="mt-1 text-justify" style="text-indent: 30px;"><?php if(!empty($row['about'])) { echo $row['about']; } else { echo 'Unavailable'; }; ?></p>
            </h6>
            <h6> 
              <b>Website's Mission:</b> <br> 
              <p class="mt-1 text-justify" style="text-indent: 30px;"><?php if(!empty($row['mission'])) { echo $row['mission']; } else { echo 'Unavailable'; }; ?></p>
            </h6>
            <h6> 
              <b>Website's Vision:</b> <br> 
              <p class="mt-1 text-justify" style="text-indent: 30px;"><?php if(!empty($row['vision'])) { echo $row['vision']; } else { echo 'Unavailable'; }; ?></p>
            </h6>
            <h6><b>Website's Contact:</b> <?php if(!empty($row['contact'])) { echo $row['contact']; } else { echo 'Unavailable'; }; ?></h6>
            <h6><b>Website's Email:</b> <?php if(!empty($row['email'])) { echo $row['email']; } else { echo 'Unavailable'; }; ?></h6>
            
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="button" class="btn bg-primary" data-toggle="modal" data-target="#update<?php echo $row['customID']; ?>" data-dismiss="modal"><i class="fas fa-pencil-alt"></i> Edit</button>
      </div>
    </div>
  </div>
</div>




<!-- UPDATE -->
<div class="modal fade" id="update<?php echo $row['customID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-gear"></i> Update settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" value="<?php echo $row['customID']; ?>" name="customID">
          <!-- LOAD IMAGE PREVIEW -->
          <div class="form-group" id="img_preview" required>
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Logo image</b></span>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload" onchange="updateimg(event)" >
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>

            </div>
            <p class="help-block text-danger">Max. 500KB</p>
          </div>

          <div class="form-group">
            <span class="text-dark"><b>Website/Brand Name</b></span>
            <input type="text" class="form-control" placeholder="Enter website name..." name="websiteName" required value="<?php echo $row['brandName']; ?>">
          </div>

          <div class="form-group">
            <span class="text-dark"><b>About This Website</b></span>
            <textarea type="text" class="form-control" placeholder="Write something about this website..." name="about" required cols="30" rows="3"><?php echo $row['about']; ?></textarea>
          </div>

          <div class="form-group">
            <span class="text-dark"><b>Website's Mission</b></span>
            <textarea type="text" class="form-control" placeholder="Enter Website's Mission..." name="mission" cols="30" rows="3"><?php echo $row['mission']; ?></textarea>
          </div>

          <div class="form-group">
            <span class="text-dark"><b>Website's Vision</b></span>
            <textarea type="text" class="form-control" placeholder="Enter Website's Vision..." name="vision" cols="30" rows="3"><?php echo $row['vision']; ?></textarea>
          </div>

          <div class="form-group">
            <span class="text-dark"><b>Website's Contact #</b></span>
            <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10" value="<?php echo $row['contact']; ?>">
          </div>

          <div class="form-group">
            <span class="text-dark"><b>Website's Email</b></span>
            <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required value="<?php echo $row['email']; ?>">
            <small id="text" style="font-style: italic;"></small>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-info" name="update_customization"><i class="fas fa-pencil-alt"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
  function updateimg(event)
  {
    var imgimage=URL.createObjectURL(event.target.files[0]);
    var imgimagediv= document.getElementById('img_preview');
    var imgnewimg=document.createElement('img');
    imgimagediv.innerHTML='';
    imgnewimg.src=imgimage;
    imgnewimg.width="100";
    imgnewimg.height="100";
    imgnewimg.style['border-radius']="50%";
    imgnewimg.style['display']="block";
    imgnewimg.style['margin-left']="auto";
    imgnewimg.style['margin-right']="auto";
    imgnewimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    imgimagediv.appendChild(imgnewimg);
  }
</script>

  



<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['customID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-gear"></i> Delete settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" value="<?php echo $row['customID']; ?>" name="customID">
          <h6 class="text-center">Delete settings record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_customization"><i class="fas fa-trash"></i> Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- SET LOGO AS ACTIVE -->
<div class="modal fade" id="active<?php echo $row['customID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-gear"></i> Active logo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" value="<?php echo $row['customID']; ?>" name="customID">
          <h6 class="text-center">Set this logo as active?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-info" name="setActive_customization"><i class="fas fa-pencil-alt"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- SET WEBSITE SETTING AS ACTIVE -->
<div class="modal fade" id="activeSettings<?php echo $row['customID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-gear"></i> Active settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" value="<?php echo $row['customID']; ?>" name="customID">
          <h6 class="text-center">Set this website setting as active?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-info" name="setActive_websiteSettings"><i class="fas fa-pencil-alt"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- VIEW LOGO -->
<div class="modal fade" id="viewphoto<?php echo $row['customID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel">Logo image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center">
          <img src="../images-customization/<?php echo $row['logo']; ?>" alt="" width="200" height="200" class="img-circle" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
      </div>
      <div class="modal-footer alert-light d-flex justify-content-center">
        <a href="../images-customization/<?php echo $row['logo']; ?>" type="button" class="btn bg-gradient-primary" download><i class="fa-solid fa-download"></i> Download</a>
      </div>
    </div>
  </div>
</div>


