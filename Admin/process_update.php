<?php 
	include '../config.php';
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/PHPMailer/src/Exception.php';
    require '../vendor/PHPMailer/src/PHPMailer.php';
    require '../vendor/PHPMailer/src/SMTP.php';
		
	// UPDATE ADMIN - ADMIN_MGMT.PHP
	if(isset($_POST['update_admin'])) {

		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$user_type		  = mysqli_real_escape_string($conn, $_POST['user_type']);
		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
		$age              = mysqli_real_escape_string($conn, $_POST['age']);
		$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
		$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
		$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
		$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
		$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
		$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
		$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
		$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
		$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
		$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
		$province         = mysqli_real_escape_string($conn, $_POST['province']);
		$region           = mysqli_real_escape_string($conn, $_POST['region']);
		$file             = basename($_FILES["fileToUpload"]["name"]);

		$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
		$row = mysqli_fetch_array($get_email);
		$existing_email = $row['email'];

		if(empty($file)) {
			if($existing_email == $email) {

				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type' WHERE user_Id='$user_Id' ");

              	  if($update) {
		          	$_SESSION['message'] = "Record has been updated!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: admin_mgmt.php?page=".$user_Id);
		          } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=".$user_Id);
		          }

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: admin_mgmt.php?page=".$user_Id);
				} else {
					  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: admin_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: admin_mgmt.php?page=".$user_Id);
			          }
				}
			}

		} else {

			if($existing_email == $email) {

				// Check if image file is a actual image or fake image
				$target_dir = "../images-users/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "File is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=".$user_Id);
					$uploadOk = 0;
				} 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "File must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=".$user_Id);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=".$user_Id);
				    $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=".$user_Id);

				// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type', image='$file' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: admin_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: admin_mgmt.php?page=".$user_Id);
			          }
						
					} else {
						$_SESSION['message'] = "There was an error uploading your profile picture.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: admin_mgmt.php?page=".$user_Id);
					}
				}

				

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: admin_mgmt.php?page=".$user_Id);
				} else {
					    // Check if image file is a actual image or fake image
						$target_dir = "../images-users/";
						$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
						$uploadOk = 1;
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check == false) {
						    $_SESSION['message']  = "File is not an image.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: admin_mgmt.php?page=".$user_Id);
							$uploadOk = 0;
						} 

						// Check file size // 500KB max size
						elseif ($_FILES["fileToUpload"]["size"] > 500000) {
						  	$_SESSION['message']  = "File must be up to 500KB in size.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: admin_mgmt.php?page=".$user_Id);
							$uploadOk = 0;
						}

						// Allow certain file formats
						elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: admin_mgmt.php?page=".$user_Id);
						    $uploadOk = 0;
						}

						// Check if $uploadOk is set to 0 by an error
						elseif ($uploadOk == 0) {
						    $_SESSION['message'] = "Your file was not uploaded.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: admin_mgmt.php?page=".$user_Id);

						// if everything is ok, try to upload file
						} else {

							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

							 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type', image='$file' WHERE user_Id='$user_Id' ");

			              	  if($update) {
					          	$_SESSION['message'] = "Record has been updated!";
					            $_SESSION['text'] = "Saved successfully!";
						        $_SESSION['status'] = "success";
								header("Location: admin_mgmt.php?page=".$user_Id);
					          } else {
					            $_SESSION['message'] = "Something went wrong while updating the information.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: admin_mgmt.php?page=".$user_Id);
					          }
								
							} else {
								$_SESSION['message'] = "There was an error uploading your profile picture.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: admin_mgmt.php?page=".$user_Id);
							}
						}
				}
			}
		}
	}





	// CHANGE ADMIN PASSWORD - ADMIN_DELETE.PHP
	if(isset($_POST['password_admin'])) {

    	$user_Id     = $_POST['user_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
			// COMPARE BOTH NEW AND CONFIRM PASSWORD
    		if($password != $cpassword) {
				$_SESSION['message']  = "Password did not matched. Please try again";
            	$_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: admin.php");
    		} else {
    			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
    			if($update_password) {
        			$_SESSION['message'] = "Password has been changed.";
	           	    $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: admin.php");
                } else {
          			$_SESSION['message'] = "Something went wrong while changing the password.";
            		$_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: admin.php");
                }
    		}
    	} else {
			$_SESSION['message']  = "Old password is incorrect.";
            $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: admin.php");
    	}
    }





    // UPDATE USER - USERS_MGMT.PHP
	if(isset($_POST['update_user'])) {

		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
		$age              = mysqli_real_escape_string($conn, $_POST['age']);
		$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
		$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
		$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
		$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
		$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
		$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
		$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
		$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
		$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
		$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
		$province         = mysqli_real_escape_string($conn, $_POST['province']);
		$region           = mysqli_real_escape_string($conn, $_POST['region']);
		$file             = basename($_FILES["fileToUpload"]["name"]);

		$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
		$row = mysqli_fetch_array($get_email);
		$existing_email = $row['email'];

		if(empty($file)) {
			if($existing_email == $email) {

				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

              	  if($update) {
		          	$_SESSION['message'] = "Record has been updated!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: users_mgmt.php?page=".$user_Id);
		          } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
		          }

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: users_mgmt.php?page=".$user_Id);
				} else {
					  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: users_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=".$user_Id);
			          }
				}
			}

		} else {

			if($existing_email == $email) {

				// Check if image file is a actual image or fake image
				$target_dir = "../images-users/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "File is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
					$uploadOk = 0;
				} 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "File must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
				    $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);

				// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: users_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=".$user_Id);
			          }
						
					} else {
						$_SESSION['message'] = "There was an error uploading your profile picture.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=".$user_Id);
					}
				}

				

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: users_mgmt.php?page=".$user_Id);
				} else {
					    // Check if image file is a actual image or fake image
						$target_dir = "../images-users/";
						$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
						$uploadOk = 1;
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check == false) {
						    $_SESSION['message']  = "File is not an image.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
							$uploadOk = 0;
						} 

						// Check file size // 500KB max size
						elseif ($_FILES["fileToUpload"]["size"] > 500000) {
						  	$_SESSION['message']  = "File must be up to 500KB in size.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
							$uploadOk = 0;
						}

						// Allow certain file formats
						elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
						    $uploadOk = 0;
						}

						// Check if $uploadOk is set to 0 by an error
						elseif ($uploadOk == 0) {
						    $_SESSION['message'] = "Your file was not uploaded.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);

						// if everything is ok, try to upload file
						} else {

							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

							 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

			              	  if($update) {
					          	$_SESSION['message'] = "Record has been updated!";
					            $_SESSION['text'] = "Saved successfully!";
						        $_SESSION['status'] = "success";
								header("Location: users_mgmt.php?page=".$user_Id);
					          } else {
					            $_SESSION['message'] = "Something went wrong while updating the information.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: users_mgmt.php?page=".$user_Id);
					          }
								
							} else {
								$_SESSION['message'] = "There was an error uploading your profile picture.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: users_mgmt.php?page=".$user_Id);
							}
						}
				}
			}
		}
	}



	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if(isset($_POST['password_user'])) {

    	$user_Id     = $_POST['user_Id'];
    	$pass        = $_POST['password'];
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
    	$row = mysqli_fetch_array($check_old_password);
    	$name = $row['firstname'].' '.$row['lastname'];
    	$email = $row['email'];
		// COMPARE BOTH NEW AND CONFIRM PASSWORD
		if($password != $cpassword) {
			$_SESSION['message']  = "Password did not matched. Please try again";
        	$_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: users.php");
		} else {
			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
			if($update_password) {


				  $subject = 'Change of password';
			      $message = '<p>Good day sir/maam '.$name.', your new password is <b>'.$pass.'</b>. Please do not share this password to other people. Thank you!</p>
			      <p><b>NOTE:</b> This is a system generated email. Please do not reply.</p> ';

			      $mail = new PHPMailer(true);                            
			      try {
			        //Server settings
			        $mail->isSMTP();                                     
			        $mail->Host = 'smtp.gmail.com';                      
			        $mail->SMTPAuth = true;                             
			        $mail->Username = 'tatakmedellin@gmail.com';     
			        $mail->Password = 'nzctaagwhqlcgbqq';              
			        $mail->SMTPOptions = array(
			        'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			        )
			        );                         
			        $mail->SMTPSecure = 'ssl';                           
			        $mail->Port = 465;                                   

			        //Send Email
			        $mail->setFrom('tatakmedellin@gmail.com');

			        //Recipients
			        $mail->addAddress($email);              
			        $mail->addReplyTo('tatakmedellin@gmail.com');

			        //Content
			        $mail->isHTML(true);                                  
			        $mail->Subject = $subject;
			        $mail->Body    = $message;

			        $mail->send();

			        	$_SESSION['message'] = "Password has been changed.";
			       	    $_SESSION['text'] = "Updated successfully!";
				        $_SESSION['status'] = "success";
						header("Location: users.php");

				  } catch (Exception $e) { 
				  	$_SESSION['message'] = "Email not sent.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users.php");
				  }


            } else {
      			$_SESSION['message'] = "Something went wrong while changing the password.";
        		$_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: users.php");
            }
		}
    }

	




    // UPDATE SELLER - SELLER_MGMT.PHP
	if(isset($_POST['update_seller'])) {

		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
		$age              = mysqli_real_escape_string($conn, $_POST['age']);
		$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
		$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
		$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
		$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
		$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
		$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
		$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
		$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
		$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
		$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
		$province         = mysqli_real_escape_string($conn, $_POST['province']);
		$region           = mysqli_real_escape_string($conn, $_POST['region']);
		$file             = basename($_FILES["fileToUpload"]["name"]);

		$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
		$row = mysqli_fetch_array($get_email);
		$existing_email = $row['email'];

		if(empty($file)) {
			if($existing_email == $email) {

				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

              	  if($update) {
		          	$_SESSION['message'] = "Record has been updated!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: seller_mgmt.php?page=".$user_Id);
		          } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: seller_mgmt.php?page=".$user_Id);
		          }

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: seller_mgmt.php?page=".$user_Id);
				} else {
					  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: seller_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: seller_mgmt.php?page=".$user_Id);
			          }
				}
			}

		} else {

			if($existing_email == $email) {

				// Check if image file is a actual image or fake image
				$target_dir = "../images-users/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "File is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: seller_mgmt.php?page=".$user_Id);
					$uploadOk = 0;
				} 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "File must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: seller_mgmt.php?page=".$user_Id);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: seller_mgmt.php?page=".$user_Id);
				    $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: seller_mgmt.php?page=".$user_Id);

				// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: seller_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: seller_mgmt.php?page=".$user_Id);
			          }
						
					} else {
						$_SESSION['message'] = "There was an error uploading your profile picture.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: seller_mgmt.php?page=".$user_Id);
					}
				}

				

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: seller_mgmt.php?page=".$user_Id);
				} else {
					    // Check if image file is a actual image or fake image
						$target_dir = "../images-users/";
						$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
						$uploadOk = 1;
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check == false) {
						    $_SESSION['message']  = "File is not an image.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: seller_mgmt.php?page=".$user_Id);
							$uploadOk = 0;
						} 

						// Check file size // 500KB max size
						elseif ($_FILES["fileToUpload"]["size"] > 500000) {
						  	$_SESSION['message']  = "File must be up to 500KB in size.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: seller_mgmt.php?page=".$user_Id);
							$uploadOk = 0;
						}

						// Allow certain file formats
						elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: seller_mgmt.php?page=".$user_Id);
						    $uploadOk = 0;
						}

						// Check if $uploadOk is set to 0 by an error
						elseif ($uploadOk == 0) {
						    $_SESSION['message'] = "Your file was not uploaded.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: seller_mgmt.php?page=".$user_Id);

						// if everything is ok, try to upload file
						} else {

							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

							 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");

			              	  if($update) {
					          	$_SESSION['message'] = "Record has been updated!";
					            $_SESSION['text'] = "Saved successfully!";
						        $_SESSION['status'] = "success";
								header("Location: seller_mgmt.php?page=".$user_Id);
					          } else {
					            $_SESSION['message'] = "Something went wrong while updating the information.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: seller_mgmt.php?page=".$user_Id);
					          }
								
							} else {
								$_SESSION['message'] = "There was an error uploading your profile picture.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: seller_mgmt.php?page=".$user_Id);
							}
						}
				}
			}
		}
	}





	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if(isset($_POST['password_seller'])) {

    	$user_Id     = $_POST['user_Id'];
    	$pass        = $_POST['password'];
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
    	$row = mysqli_fetch_array($check_old_password);
    	$name = $row['firstname'].' '.$row['lastname'];
    	$email = $row['email'];
		// COMPARE BOTH NEW AND CONFIRM PASSWORD
		if($password != $cpassword) {
			$_SESSION['message']  = "Password did not matched. Please try again";
        	$_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: seller.php");
		} else {
			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
			if($update_password) {


				  $subject = 'Change of password';
			      $message = '<p>Good day sir/maam '.$name.', your new password is <b>'.$pass.'</b>. Please do not share this password to other people. Thank you!</p>
			      <p><b>NOTE:</b> This is a system generated email. Please do not reply.</p> ';

			      $mail = new PHPMailer(true);                            
			      try {
			        //Server settings
			        $mail->isSMTP();                                     
			        $mail->Host = 'smtp.gmail.com';                      
			        $mail->SMTPAuth = true;                             
			        $mail->Username = 'tatakmedellin@gmail.com';     
			        $mail->Password = 'nzctaagwhqlcgbqq';              
			        $mail->SMTPOptions = array(
			        'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			        )
			        );                         
			        $mail->SMTPSecure = 'ssl';                           
			        $mail->Port = 465;                                   

			        //Send Email
			        $mail->setFrom('tatakmedellin@gmail.com');

			        //Recipients
			        $mail->addAddress($email);              
			        $mail->addReplyTo('tatakmedellin@gmail.com');

			        //Content
			        $mail->isHTML(true);                                  
			        $mail->Subject = $subject;
			        $mail->Body    = $message;

			        $mail->send();

			        	$_SESSION['message'] = "Password has been changed.";
			       	    $_SESSION['text'] = "Updated successfully!";
				        $_SESSION['status'] = "success";
						header("Location: seller.php");

				  } catch (Exception $e) { 
				  	$_SESSION['message'] = "Email not sent.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: seller.php");
				  }


            } else {
      			$_SESSION['message'] = "Something went wrong while changing the password.";
        		$_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: seller.php");
            }
		}
    }





	// UPDATE ADMIN INFO - PROFILE.PHP
	if(isset($_POST['update_profile_info'])) {

		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
		$age              = mysqli_real_escape_string($conn, $_POST['age']);
		$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
		$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
		$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
		$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
		$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
		$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
		$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
		$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
		$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
		$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
		$province         = mysqli_real_escape_string($conn, $_POST['province']);
		$region           = mysqli_real_escape_string($conn, $_POST['region']);

		$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
		$row = mysqli_fetch_array($get_email);
		$existing_email = $row['email'];

		if($existing_email == $email) {

				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

              	  if($update) {
		          	$_SESSION['message'] = "Record has been updated!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: profile.php");
		          } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: profile.php");
		          }

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: profile.php");
				} else {
					  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: profile.php");
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: profile.php");
			          }
				}
			}
	}



	// CHANGE ADMIN PASSWORD - PROFILE.PHP
	if(isset($_POST['update_password_admin'])) {

    	$user_Id    = $_POST['user_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
			// COMPARE BOTH NEW AND CONFIRM PASSWORD
    		if($password != $cpassword) {
				$_SESSION['message']  = "Password does not matched. Please try again";
            	$_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: profile.php");
    		} else {
    			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
    			if($update_password) {
                	$_SESSION['message'] = "Password has been changed.";
		            $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: profile.php");
                } else {
                    $_SESSION['message'] = "Something went wrong while changing the password.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: profile.php");
                }
    		}
    	} else {
			$_SESSION['message']  = "Old password is incorrect.";
            $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: profile.php");
    	}

    }




  	// UPDATE ADMIN PROFILE - PROFILE.PHP
	if(isset($_POST['update_profile_admin'])) {

		$user_Id    = $_POST['user_Id'];
		$file       = basename($_FILES["fileToUpload"]["name"]);

		  // Check if image file is a actual image or fake image
	    $target_dir = "../images-users/";
	    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check == false) {
		    $_SESSION['message']  = "Selected file is not an image.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: profile.php");
	    	$uploadOk = 0;
	    } 

		// Check file size // 500KB max size
		elseif ($_FILES["fileToUpload"]["size"] > 500000) {
		  	$_SESSION['message']  = "File must be up to 500KB in size.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: profile.php");
	    	$uploadOk = 0;
		}

	    // Allow certain file formats
	    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
		    $_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: profile.php");
	    	$uploadOk = 0;
	    }

	    // Check if $uploadOk is set to 0 by an error
	    elseif ($uploadOk == 0) {
		    $_SESSION['message']  = "Your file was not uploaded.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: profile.php");

	    // if everything is ok, try to upload file
	    } else {

	        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	          	$save = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$user_Id'");
	     
	            if($save) {
	            	$_SESSION['message'] = "Profile picture has been updated!";
		            $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: profile.php");
	            } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: profile.php");
	            }
	        } else {
	            $_SESSION['message'] = "There was an error uploading your file.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: profile.php");
	        }

		}
	}




	// UPDATE CUSTOMIZATION - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['update_customization'])) {
		$customID    = $_POST['customID'];
		$file        = basename($_FILES["fileToUpload"]["name"]);
		$websiteName = mysqli_real_escape_string($conn, $_POST['websiteName']);
		$about       = mysqli_real_escape_string($conn, $_POST['about']);
		$mission     = mysqli_real_escape_string($conn, $_POST['mission']);
		$vision      = mysqli_real_escape_string($conn, $_POST['vision']);
		$contact     = mysqli_real_escape_string($conn, $_POST['contact']);
		$email       = mysqli_real_escape_string($conn, $_POST['email']);  

		if(empty($file)) {
			$exist = mysqli_query($conn, "SELECT * FROM customization WHERE customID='$customID'");	
			$row = mysqli_fetch_array($exist);
			$old_brandName = $row['brandName'];

			if($old_brandName == $websiteName) {
				$update = mysqli_query($conn, "UPDATE customization SET brandName='$websiteName', about='$about', mission='$mission', vision='$vision', contact='$contact', email='$email' WHERE customID='$customID'");
				if($update) {
		        	$_SESSION['message'] = "Website settings has been updated!";
		            $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: customize.php");
		        } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: customize.php");
		        } 
			} else {
				$webName = mysqli_query($conn, "SELECT * FROM customization WHERE brandName='$websiteName'");
				if(mysqli_num_rows($webName) > 0) {
					$_SESSION['message'] = "Website name already exists.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: customize.php");
				} else {
					$update = mysqli_query($conn, "UPDATE customization SET brandName='$websiteName', about='$about', mission='$mission', vision='$vision', contact='$contact', email='$email' WHERE customID='$customID'");
					if($update) {
			        	$_SESSION['message'] = "Website settings has been updated!";
			            $_SESSION['text'] = "Updated successfully!";
				        $_SESSION['status'] = "success";
						header("Location: customize.php");
			        } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: customize.php");
			        } 
				}
			}
		} else {
			if($file == $row['picture']) {
				$_SESSION['message'] = "Image is still the same.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: customize.php");
			} else {
				$exist = mysqli_query($conn, "SELECT * FROM customization WHERE customID='$customID'");	
				$row = mysqli_fetch_array($exist);
				$old_brandName = $row['brandName'];

				if($old_brandName == $websiteName) {
					
					// Check if image file is a actual image or fake image
					$sign_target_dir = "../images-customization/";
					$sign_target_file = $sign_target_dir . basename($_FILES["fileToUpload"]["name"]);
					$sign_uploadOk = 1;
					$sign_imageFileType = strtolower(pathinfo($sign_target_file,PATHINFO_EXTENSION));

					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check == false) {
					    $_SESSION['message']  = "Signature file is not an image.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: customize.php");
						$uploadOk = 0;
					} 

					// Check file size // 500KB max size
					elseif ($_FILES["fileToUpload"]["size"] > 500000) {
					  	$_SESSION['message']  = "File must be up to 500KB in size.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: customize.php");
						$uploadOk = 0;
					}

					// Allow certain file formats
					elseif($sign_imageFileType != "jpg" && $sign_imageFileType != "png" && $sign_imageFileType != "jpeg" && $sign_imageFileType != "gif" ) {
					    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: customize.php");
					    $sign_uploadOk = 0;
					}

					// Check if $sign_uploadOk is set to 0 by an error
					elseif ($sign_uploadOk == 0) {
					    $_SESSION['message'] = "Your file was not uploaded.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: customize.php");

					// if everything is ok, try to upload file
					} else {

						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $sign_target_file)) {
							$update = mysqli_query($conn, "UPDATE customization SET logo='$file', brandName='$websiteName', about='$about', mission='$mission', vision='$vision', contact='$contact', email='$email' WHERE customID='$customID'");
							if($update) {
					        	$_SESSION['message'] = "Image customization has been updated!";
					            $_SESSION['text'] = "Updated successfully!";
						        $_SESSION['status'] = "success";
								header("Location: customize.php");
					        } else {
					            $_SESSION['message'] = "Something went wrong while updating the information.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: customize.php");
					        }  	
						} else {
							$_SESSION['message'] = "There was an error uploading your digital signature.";
					    	$_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: customize.php");
						}
					} 
				} else {
					$webName = mysqli_query($conn, "SELECT * FROM customization WHERE brandName='$websiteName'");
					if(mysqli_num_rows($webName) > 0) {
						$_SESSION['message'] = "Website name already exists.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: customize.php");
					} else {
						// Check if image file is a actual image or fake image
						$sign_target_dir = "../images-customization/";
						$sign_target_file = $sign_target_dir . basename($_FILES["fileToUpload"]["name"]);
						$sign_uploadOk = 1;
						$sign_imageFileType = strtolower(pathinfo($sign_target_file,PATHINFO_EXTENSION));

						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check == false) {
						    $_SESSION['message']  = "Signature file is not an image.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: customize.php");
							$uploadOk = 0;
						} 

						// Check file size // 500KB max size
						elseif ($_FILES["fileToUpload"]["size"] > 500000) {
						  	$_SESSION['message']  = "File must be up to 500KB in size.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: customize.php");
							$uploadOk = 0;
						}

						// Allow certain file formats
						elseif($sign_imageFileType != "jpg" && $sign_imageFileType != "png" && $sign_imageFileType != "jpeg" && $sign_imageFileType != "gif" ) {
						    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: customize.php");
						    $sign_uploadOk = 0;
						}

						// Check if $sign_uploadOk is set to 0 by an error
						elseif ($sign_uploadOk == 0) {
						    $_SESSION['message'] = "Your file was not uploaded.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: customize.php");

						// if everything is ok, try to upload file
						} else {

							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $sign_target_file)) {
								$update = mysqli_query($conn, "UPDATE customization SET logo='$file', brandName='$websiteName', about='$about', mission='$mission', vision='$vision', contact='$contact', email='$email' WHERE customID='$customID'");
								if($update) {
						        	$_SESSION['message'] = "Image customization has been updated!";
						            $_SESSION['text'] = "Updated successfully!";
							        $_SESSION['status'] = "success";
									header("Location: customize.php");
						        } else {
						            $_SESSION['message'] = "Something went wrong while updating the information.";
						            $_SESSION['text'] = "Please try again.";
							        $_SESSION['status'] = "error";
									header("Location: customize.php");
						        }  	
							} else {
								$_SESSION['message'] = "There was an error uploading your digital signature.";
						    	$_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: customize.php");
							}
						} 
					}
				}
			}
		}
		
		
		
	}




	// SET ACTIVE - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['setActive_customization'])) {

		$customID = $_POST['customID'];

		$update = mysqli_query($conn, "UPDATE customization SET logoStatus=0");
		if($update) {
			$update2 = mysqli_query($conn, "UPDATE customization SET logoStatus=1 WHERE customID='$customID'");
        	if($update2) {
        		$_SESSION['message'] = "Logo is now Active.";
	            $_SESSION['text'] = "Updated successfully!";
		        $_SESSION['status'] = "success";
				header("Location: customize.php");
			} else {
				$_SESSION['message'] = "Something went wrong while settings the image as Active.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: customize.php");
			}
        } else {
            $_SESSION['message'] = "Something went wrong while settings the image as Active.";
            $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: customize.php");
        } 
	}





	// SET ACTIVE - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['setActive_websiteSettings'])) {

		$customID = $_POST['customID'];

		$update = mysqli_query($conn, "UPDATE customization SET status=0");
		if($update) {
			$update2 = mysqli_query($conn, "UPDATE customization SET status=1 WHERE customID='$customID'");
        	if($update2) {
        		$_SESSION['message'] = "Website settings is now Active.";
	            $_SESSION['text'] = "Updated successfully!";
		        $_SESSION['status'] = "success";
				header("Location: customize.php");
			} else {
				$_SESSION['message'] = "Something went wrong while settings the image as Active.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: customize.php");
			}
        } else {
            $_SESSION['message'] = "Something went wrong while settings the image as Active.";
            $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: customize.php");
        } 
	}




	// UPDATE ACTIVITIY - ACTIVITY_UPDATE_DELETE.PHP
	if(isset($_POST['update_activity'])) {
		$actId 			= $_POST['actId'];
		$activity       = $_POST['activity'];
		$actDate        = $_POST['actDate'];
		$date_acquired  = date('Y-m-d');
		$update = mysqli_query($conn, "UPDATE announcement SET actName='$activity', actDate='$actDate' WHERE actId='$actId'");

		  if($update) {
		  	$_SESSION['message'] = "Announcement has been updated.";
		    $_SESSION['text'] = "Updated successfully!";
		    $_SESSION['status'] = "success";
			header("Location: announcement.php");
		  } else {
		    $_SESSION['message'] = "Something went wrong while saving the information.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: announcement.php");
		  }
	}




	// UPDATE PRODUCT CATEGORY - CATEGORY_UPDATE_DELETE.PHP
	if(isset($_POST['update_category'])) {
		$cat_id   = mysqli_real_escape_string($conn, $_POST['cat_id']);
		$category = mysqli_real_escape_string($conn, $_POST['category']);

		$getCat = mysqli_query($conn, "SELECT * FROM category WHERE cat_id='$cat_id'");
		$row = mysqli_fetch_array($getCat);

		if ($category == $row['cat_name']) {
			$update = mysqli_query($conn, "UPDATE category SET cat_name='$category' WHERE cat_id='$cat_id'");
			if($update) {
				$_SESSION['message'] = "Category has been updated.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "success";
				header("Location: category.php");
			} else {
				$_SESSION['message'] = "Something went wrong while updating book category.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: category.php");
			}
		} else {
			$fetch = mysqli_query($conn, "SELECT * FROM category WHERE cat_name='$category'");
			if(mysqli_num_rows($fetch) > 0) {
				$_SESSION['message'] = "Category already exists.";
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: category.php");
			} else {
				$update = mysqli_query($conn, "UPDATE category SET cat_name='$category' WHERE cat_id='$cat_id'");
				if($update) {
					$_SESSION['message'] = "Category has been updated.";
			        $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "success";
					header("Location: category.php");
				} else {
					$_SESSION['message'] = "Something went wrong while updating book category.";
			        $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: category.php");
				}
			}
		}	
	}






	// UPDATE PRODUCT - PRODUCT_UPDATE_DELETE.PHP
	if(isset($_POST['update_product'])) {
		$product_Id     = $_POST['product_Id'];
		$product_cat_Id = mysqli_real_escape_string($conn, $_POST['product_cat_Id']);
		$product_name   = mysqli_real_escape_string($conn, $_POST['product_name']);
		$product_desc   = mysqli_real_escape_string($conn, $_POST['product_desc']);
		$starting_price = mysqli_real_escape_string($conn, $_POST['starting_price']);

		$bid_due_date	= mysqli_real_escape_string($conn, $_POST['bid_due_date']);
		// Convert the input date string to a Unix timestamp
		$timestamp      = strtotime($bid_due_date);
		// Convert the Unix timestamp to a string in MySQL datetime format
		$new_bid_due_date = date('Y-m-d H:i:s', $timestamp);

		$file           = basename($_FILES["fileToUpload"]["name"]);

		// CHECK OLD VALUES
		$check = mysqli_query($conn, "SELECT * FROM product WHERE product_Id='$product_Id'");
		$prod  = mysqli_fetch_array($check);
		$prod_name = $prod['product_name'];

		// CHECK EXIST
		$fetch = mysqli_query($conn, "SELECT * FROM product WHERE product_name='$product_name'");

		if (empty($file)) {
			if ($prod_name == $product_name) {
				  $update = mysqli_query($conn, "UPDATE product SET product_cat_Id='$product_cat_Id', product_name='$product_name', product_desc='$product_desc', starting_price='$starting_price', bid_due_date='$new_bid_due_date' WHERE product_Id='$product_Id'");
				  if($update) {
		          	$_SESSION['message'] = "Product has been updated!";
		            $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: product_mgmt.php?page=".$product_Id);
		          } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: product_mgmt.php?page=".$product_Id);
		          }
			} else {
				if(mysqli_num_rows($fetch) > 0) {
					$_SESSION['message'] = "Product already exists.";
		            $_SESSION['text'] = "Please try again.";
		        	$_SESSION['status'] = "error";
					header("Location: product_mgmt.php?page=".$product_Id);
				} else {
					  $update = mysqli_query($conn, "UPDATE product SET product_cat_Id='$product_cat_Id', product_name='$product_name', product_desc='$product_desc', starting_price='$starting_price', bid_due_date='$new_bid_due_date' WHERE product_Id='$product_Id'");
					  if($update) {
			          	$_SESSION['message'] = "Product has been updated!";
			            $_SESSION['text'] = "Updated successfully!";
				        $_SESSION['status'] = "success";
						header("Location: product_mgmt.php?page=".$product_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: product_mgmt.php?page=".$product_Id);
			          }
				}
			}

		} else {
			if ($prod_name == $product_name) {
				// Check if image file is a actual image or fake image
			    $target_dir = "../images-product/";
			    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			    $uploadOk = 1;
			    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "File is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: product_mgmt.php?page=create");
			    	$uploadOk = 0;
			    } 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "File must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: product_mgmt.php?page=create");
			    	$uploadOk = 0;
				}

			    // Allow certain file formats
			    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: product_mgmt.php?page=create");
				    $uploadOk = 0;
			    }

			    // Check if $uploadOk is set to 0 by an error
			    elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: product_mgmt.php?page=create");

			    // if everything is ok, try to upload file
			    } else {

			        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		        		  $update = mysqli_query($conn, "UPDATE product SET product_cat_Id='$product_cat_Id', product_name='$product_name', product_desc='$product_desc', starting_price='$starting_price', bid_due_date='$new_bid_due_date', product_image='$file' WHERE product_Id='$product_Id'");
						  if($update) {
				          	$_SESSION['message'] = "Product has been updated!";
				            $_SESSION['text'] = "Updated successfully!";
					        $_SESSION['status'] = "success";
							header("Location: product_mgmt.php?page=".$product_Id);
				          } else {
				            $_SESSION['message'] = "Something went wrong while updating the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: product_mgmt.php?page=".$product_Id);
				          }
			       			
			        } else {
			        	$_SESSION['message'] = "There was an error uploading your profile picture.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: product_mgmt.php?page=create");
			        }
			  }
			} else {

				if(mysqli_num_rows($fetch) > 0) {
					$_SESSION['message'] = "Product already exists.";
		            $_SESSION['text'] = "Please try again.";
		        	$_SESSION['status'] = "error";
					header("Location: product_mgmt.php?page=".$product_Id);
				} else {
					    // Check if image file is a actual image or fake image
					    $target_dir = "../images-product/";
					    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					    $uploadOk = 1;
					    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


					    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check == false) {
						    $_SESSION['message']  = "File is not an image.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: product_mgmt.php?page=create");
					    	$uploadOk = 0;
					    } 

						// Check file size // 500KB max size
						elseif ($_FILES["fileToUpload"]["size"] > 500000) {
						  	$_SESSION['message']  = "File must be up to 500KB in size.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: product_mgmt.php?page=create");
					    	$uploadOk = 0;
						}

					    // Allow certain file formats
					    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: product_mgmt.php?page=create");
						    $uploadOk = 0;
					    }

					    // Check if $uploadOk is set to 0 by an error
					    elseif ($uploadOk == 0) {
						    $_SESSION['message'] = "Your file was not uploaded.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: product_mgmt.php?page=create");

					    // if everything is ok, try to upload file
					    } else {

					        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

				        		  $update = mysqli_query($conn, "UPDATE product SET product_cat_Id='$product_cat_Id', product_name='$product_name', product_desc='$product_desc', starting_price='$starting_price', bid_due_date='$new_bid_due_date', product_image='$file' WHERE product_Id='$product_Id'");
								  if($update) {
						          	$_SESSION['message'] = "Product has been updated!";
						            $_SESSION['text'] = "Updated successfully!";
							        $_SESSION['status'] = "success";
									header("Location: product_mgmt.php?page=".$product_Id);
						          } else {
						            $_SESSION['message'] = "Something went wrong while updating the information.";
						            $_SESSION['text'] = "Please try again.";
							        $_SESSION['status'] = "error";
									header("Location: product_mgmt.php?page=".$product_Id);
						          }
					       			
					        } else {
					        	$_SESSION['message'] = "There was an error uploading your profile picture.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: product_mgmt.php?page=create");
					        }
					  }
				}

			}
		}

	}



?>
