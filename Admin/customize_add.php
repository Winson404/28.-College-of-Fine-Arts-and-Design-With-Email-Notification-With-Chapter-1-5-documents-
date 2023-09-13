<!-- CREATE NEW -->
<div class="modal fade" id="add_users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-gear"></i> Create new settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
            <!-- LOAD IMAGE PREVIEW -->
            <div class="form-group" id="user_preview" required>
            </div>
            <div class="form-group">
              <span class="text-dark"><b>Logo image</b></span>
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

            <div class="form-group">
              <span class="text-dark"><b>Website/Brand Name</b></span>
              <input type="text" class="form-control" placeholder="Enter website name..." name="websiteName" required>
            </div>

            <div class="form-group">
              <span class="text-dark"><b>About This Website</b></span>
              <textarea type="text" class="form-control" placeholder="Write something about this website..." name="about" required cols="30" rows="3"></textarea>
            </div>

            <div class="form-group">
              <span class="text-dark"><b>Website's Mission</b></span>
              <textarea type="text" class="form-control" placeholder="Enter Website's Mission..." name="mission" cols="30" rows="3"></textarea>
            </div>

            <div class="form-group">
              <span class="text-dark"><b>Website's Vision</b></span>
              <textarea type="text" class="form-control" placeholder="Enter Website's Vision..." name="vision" cols="30" rows="3"></textarea>
            </div>

            <div class="form-group">
              <span class="text-dark"><b>Website's Contact #</b></span>
              <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10">
            </div>

            <div class="form-group">
              <span class="text-dark"><b>Website's Email</b></span>
              <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required>
              <small id="text" style="font-style: italic;"></small>
            </div>

      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="create_customization" id="create_admin"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
  function newgetImagePreview(event)
  {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('user_preview');
    var newimg=document.createElement('img');
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="100";
    newimg.height="100";
    newimg.style['border-radius']="50%";
    newimg.style['display']="block";
    newimg.style['margin-left']="auto";
    newimg.style['margin-right']="auto";
    newimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    imagediv.appendChild(newimg);
  }
</script>


