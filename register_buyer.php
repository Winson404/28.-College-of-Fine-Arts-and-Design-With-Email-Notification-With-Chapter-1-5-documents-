<?php include 'navbar.php';?>
<title><?php echo $settings_name; ?> | Register</title>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-dark" >
    
    <!-- Main content -->
    <div class="content text-dark">
      <div class="container">
        <div class="row d-flex justify-content-center">

          <div class="col-lg-10 mt-5">
            <form action="processes.php" method="POST" enctype="multipart/form-data">
            <div class="card card-outline card-primary">
              <div class="card-header text-center">
                <a href="#" class="h1"><b>Bidder Registration</b></a>
              </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-12 mt-1 mb-2">
                          <a class="h5 text-primary"><b>Basic information</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>First name</b></span>
                              <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)">
                            </div>
                        </div>
                        <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                              <span class="text-dark"><b>Middle name</b></span>
                              <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)">
                          </div>
                        </div>
                        <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Last name</b></span>
                              <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Ext/Suffix</b></span>
                            <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix">
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Date of Birth</b></span>
                              <input type="date" class="form-control" name="dob" placeholder="Date of birth" required id="birthdate" onchange="calculateAge()">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Age</b></span>
                              <input type="text" class="form-control bg-white" placeholder="Select DOB first" required id="txtage" name="age" readonly>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Place of Birth</b></span>
                              <textarea name="birthplace" id="" cols="30" rows="1" class="form-control" required placeholder="Place of Birth"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Sex</b></span>
                            <select class="form-control" name="gender" required>
                              <option selected disabled value="">Select sex</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Non-Binary">Non-Binary</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Civil Status</b></span>
                            <select class="form-control" name="civilstatus" required>
                              <option selected disabled value="">Select status</option>
                              <option value="Single">Single</option>
                              <option value="Married">Married</option>
                              <option value="Widow/ER">Widow/ER</option>
                              <option value="Separated">Separated</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Profession/ Occupation</b></span>
                              <input type="text" class="form-control"  placeholder="Profession/ Occupation" name="occupation" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Religion</b></span>
                            <select class="form-control" name="religion" required>
                              <option selected disabled value="">Select religion</option>
                              <option value="Roman Catholic">Roman Catholic</option>
                              <option value="Iglesia Ni Cristo">Iglesia Ni Cristo</option>
                              <option value="Evangelical Christianity">Evangelical Christianity</option>
                              <option value="Islam">Islam</option>
                              <option value="Protestants">Protestants</option>
                              <option value="Seventh-day Adventism">Seventh-day Adventism</option>
                              <option value="Aglipayan">Aglipayan</option>
                              <option value="Bible Baptist Church">Bible Baptist Church</option>
                              <option value="United Church of Christ in the Philippines">United Church of Christ in the Philippines</option>
                              <option value="Jehovah's Witnesses">Jehovah's Witnesses</option>
                              <option value="Buddhist">Buddhist</option>
                              <option value="Methodist">Methodist</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Judaism">Judaism</option>
                              <option value="Ang Dating Daan">Ang Dating Daan</option>
                              <option value="Other Religion">Other Religion</option>
                            </select>
                          </div>
                        </div>


                        <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                          <a class="h5 text-primary"><b>Contact details</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Email</b></span>
                              <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required>
                              <small id="text" style="font-style: italic;"></small>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Contact number</b></span>
                              <div class="input-group">
                                <div class="input-group-text">+63</div>
                                <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10">
                              </div>
                            </div>
                        </div>
                        

                        <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                          <a class="h5 text-primary"><b>Complete ddress</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>House No.</b></span>
                              <input type="text" class="form-control"  placeholder="House No." name="house_no">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Street name</b></span>
                              <input type="text" class="form-control"  placeholder="Street name" name="street_name">
                            </div>
                        </div>
                         <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Sitio/Purok</b></span>
                              <input type="text" class="form-control"  placeholder="Sitio/Purok" name="purok">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Zone</b></span>
                              <input type="text" class="form-control"  placeholder="Zone" name="zone">
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Barangay</b></span>
                              <input type="text" class="form-control"  placeholder="Barangay" name="barangay" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Municipality</b></span>
                              <input type="text" class="form-control"  placeholder="Municipality" name="municipality" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Province</b></span>
                              <input type="text" class="form-control"  placeholder="Province" name="province" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Region</b></span>
                              <input type="text" class="form-control"  placeholder="Region" name="region" required>
                            </div>
                        </div>



                        <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                          <a class="h5 text-primary"><b>Account password</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Password</b></span>
                              <input type="password" id="password" class="form-control" name="password" placeholder="Password" minlength="8">
                              <span id="password-message" class="text-bold" style="font-style: italic;font-size: 12px;color: #e60000;"></span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Confirm password</b></span>
                              <input type="password" class="form-control" name="cpassword" placeholder="Retype password" id="cpassword" onkeyup="validate_password_confirm_password()" required minlength="8">
                              <small id="wrong_pass_alert" class="text-bold" style="font-style: italic;font-size: 12px;"></small>
                            </div>
                        </div>


                        <div class="col-lg-12 mt-3 mb-2">
                          <a class="h5 text-primary"><b>Additional information</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        
                        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>User photo</b></span>
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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="form-group" id="preview">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <input type="checkbox" required> Accept <a type="button" href="" data-toggle="modal" data-target="#exampleModal" style="text-decoration: none;">Terms and Privacy</a>
                        </div>
                        <div class="col-12">
                          <hr>
                          <p>Already have an account? <a href="login.php">Click here!</a></p>
                        </div>

                    </div>
                    <!-- END ROW -->
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <button type="submit" class="btn bg-primary" name="create_buyer" id="create_admin"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                  </div>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    <!-- /.content -->
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
  </div>
  <!-- /.content-wrapper -->



  <!-- Modal for TERMS AND AGREEMENT -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-light">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Agreement</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
          </button>
        </div>
        <div class="modal-body">
            <p style="text-align: justify;">i-LaFI respects the privacy of the users. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website i-LaFi. Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, please do not access the site.</p>
            <p style="text-align: justify;">We reserve the right to make changes to this Privacy Policy at any time and for any reason. We will alert you about any changes by updating the "Last Updated" date of this Privacy Policy on the Site. and you waive the right to receieve specific notice of each such change or modification.</p>
            <p style="text-align: justify;">You are encouraged to periodically review this Privacy Policy to stay informed of updates. You will be deemed to have been made aware of, will be subject to, and will be deemed to have accepted the changes in any revised Privacy Policy by your continued use of the Site after the date such revised Privacy Policy is posted.</p>
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Close</button>
        </div>
      </div>
    </div>
  </div>



<?php include 'footer.php'; ?>
