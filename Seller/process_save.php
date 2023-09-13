<?php 
	include '../config.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../vendor/PHPMailer/src/Exception.php';
	require '../vendor/PHPMailer/src/PHPMailer.php';
	require '../vendor/PHPMailer/src/SMTP.php';
	date_default_timezone_set('Asia/Manila');


	// SAVE PRODUCT - PRODUCT_ADD.PHP
	if(isset($_POST['create_product'])) {
		$user_Id        = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$product_cat_Id = mysqli_real_escape_string($conn, $_POST['product_cat_Id']);
		$product_name   = mysqli_real_escape_string($conn, $_POST['product_name']);
		$product_desc   = mysqli_real_escape_string($conn, $_POST['product_desc']);
		$starting_price = mysqli_real_escape_string($conn, $_POST['starting_price']);
		
		$bid_due_date	  = mysqli_real_escape_string($conn, $_POST['bid_due_date']);
		// Convert the input date string to a Unix timestamp
		$timestamp = strtotime($bid_due_date);

		// Convert the Unix timestamp to a string in MySQL datetime format
		$new_bid_due_date = date('Y-m-d H:i:s', $timestamp);
		
		$file           = basename($_FILES["fileToUpload"]["name"]);

		$fetch = mysqli_query($conn, "SELECT * FROM product WHERE product_name='$name'");
		if(mysqli_num_rows($fetch) > 0) {
            $_SESSION['message'] = "Product already exists.";
            $_SESSION['text'] = "Please try again.";
        	$_SESSION['status'] = "error";
			header("Location: product_mgmt.php?page=create");
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

	        		$save = mysqli_query($conn, "INSERT INTO product (user_Id, product_cat_Id, product_name, product_desc, starting_price, bid_due_date, product_image) VALUES ('$user_Id', '$product_cat_Id', '$product_name', '$product_desc', '$starting_price', '$new_bid_due_date', '$file')");

	              	  if($save) {
			          	$_SESSION['message'] = "Product has been saved!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: product_mgmt.php?page=create");
			          } else {
			            $_SESSION['message'] = "Something went wrong while saving the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: product_mgmt.php?page=create");
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







	// AUTO BIDDING
	if(isset($_POST['productId'])) {
	  $productId = $_POST['productId'];

	    $sql = mysqli_query($conn, "SELECT *, MAX(CAST(bidding_price AS DECIMAL)) as max_bidding_price 
		FROM bidding
		WHERE product_Id='$productId'
		GROUP BY user_Id
		ORDER BY max_bidding_price DESC
		LIMIT 1;");

		if (mysqli_num_rows($sql) > 0) {
		    // Output largest bidding price
		    $row_max = mysqli_fetch_array($sql);
		    $max_bid_Id = $row_max['bidding_Id'];
				$max_bid_user = $row_max['user_Id'];
				$max_bid_price = $row_max['max_bidding_price'];

				// GET USER INFO WHO BUYS THE PRODUCT
				$getEmail = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$max_bid_user'");
				$getEmail_row = mysqli_fetch_array($getEmail);
				$buyerEmail = $getEmail_row['email'];

				// GET USER INFO WHO ADDED THE PRODUCT
				$getEmail2 = mysqli_query($conn, "SELECT * FROM product JOIN users ON product.user_Id=users.user_Id WHERE product.product_Id='$productId'");
				$getEmail_row2 = mysqli_fetch_array($getEmail2);
				$buyerEmail2 = $getEmail_row2['email'];

		    $update = mysqli_query($conn, "UPDATE product SET product_status=1 WHERE product_Id='$productId'");
			  if($update) {
			  	$save = mysqli_query($conn, "INSERT INTO bidding_winner (user_Id, product_Id) VALUES ('$max_bid_user', '$productId') ");
			  	if($save) {

			  		$updateBidding = mysqli_query($conn, "UPDATE bidding SET bidding_status=1 WHERE bidding_Id='$max_bid_Id'");
			  		if($updateBidding) {
			  			$updateStatus = mysqli_query($conn, "UPDATE bidding SET bidding_status=2 WHERE bidding_Id !='$max_bid_Id' AND product_Id='$productId'");
			  			if($updateStatus) {
			  				// SEND EMAIL TO BUYER
				  		  $subject = 'Bidding Notification';
					      $message = '<p>Good day sir/maam '.$buyerEmail.', this is to inform you that you have won the bidding on your selected product. Thank you!</p>
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
					        $mail->addAddress($buyerEmail);              
					        $mail->addReplyTo('tatakmedellin@gmail.com');

					        //Content
					        $mail->isHTML(true);                                  
					        $mail->Subject = $subject;
					        $mail->Body    = $message;

					        $mail->send();
					        if($mail->send()) {
					        	// SEND EMAIL TO BUYER
						  		  $subject = 'Bidding Notification';
							      $message = '<p>Good day sir/maam '.$buyerEmail2.', this is to inform you that the bidding of your product has ended. Thank you!</p>
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
							        $mail->addAddress($buyerEmail2);              
							        $mail->addReplyTo('tatakmedellin@gmail.com');

							        //Content
							        $mail->isHTML(true);                                  
							        $mail->Subject = $subject;
							        $mail->Body    = $message;

							        $mail->send();
							        echo "Email sent to both buyer and seller successfully";				        
								  } catch (Exception $e) { 
								  	echo "Email not sent to buyer.";
								  } 
					        }		        
							  } catch (Exception $e) { 
							  	echo "Email not sent to buyer.";
							  } 
			  			} else {
			  				echo "Can not update bidding to status 2.";
			  			}
			  		} else {
			  			echo "Can not update bidding to status 1.";
			  		}








			  		





					  











			  		
			  	} else {
			  		echo "Saving into bidding winner table failed.";
			  	}
			  } else {
			  	echo "Updating the product status failed.";
			  }
		} else {
		    // GET USER INFO WHO ADDED THE PRODUCT
				$getEmail2 = mysqli_query($conn, "SELECT * FROM product JOIN users ON product.user_Id=users.user_Id WHERE product.product_Id='$productId'");
				$getEmail_row2 = mysqli_fetch_array($getEmail2);
				$buyerEmail2 = $getEmail_row2['email'];
			  // SEND EMAIL TO BUYER
	  		  $subject = 'Bidding Notification';
		      $message = '<p>Good day sir/maam '.$buyerEmail2.', this is to inform you that the bidding of your product has ended and no one has bidded on it. Thank you!</p>
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
		        $mail->addAddress($buyerEmail2);              
		        $mail->addReplyTo('tatakmedellin@gmail.com');

		        //Content
		        $mail->isHTML(true);                                  
		        $mail->Subject = $subject;
		        $mail->Body    = $message;

		        $mail->send();
		        echo "Email sent to seller successfully.";				        
			  } catch (Exception $e) { 
			  	echo "Email not sent to buyer.";
			  } 
		}

	}



	


	// CONTACT EMAIL MESSAGING - CONTACT-US.PHP
	if(isset($_POST['sendEmail'])) {

		$name    = mysqli_real_escape_string($conn, $_POST['name']);
		$email	 = mysqli_real_escape_string($conn, $_POST['email']);
		$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		$msg     = mysqli_real_escape_string($conn, $_POST['message']);

	    $message = '<h3>'.$subject.'</h3>
					<p>
						Good day!<br>
						'.$msg.'
					</p>
					<p>
						Name of Sender: '.$name.'<br>
						Email: '.$email.'
					</p>
					<p><b>Note:</b> This is a system generated email please do not reply.</p>';
					//Load composer's autoloader

			    $mail = new PHPMailer(true);                            
			    try {
			        //Server settings
			        $mail->isSMTP();                                     
			        $mail->Host = 'smtp.gmail.com';                      
			        $mail->SMTPAuth = true;                             
			        $mail->Username = 'nhsmedellin@gmail.com';     
	        		$mail->Password = 'fgzyhjjhjxdikkjp';                
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
			        $mail->setFrom('nhsmedellin@gmail.com');
			        
			        //Recipients
			        $mail->addAddress('sonerwin12@gmail.com');              
			        $mail->addReplyTo('sonesrwin12@gmail.com');
			        
			        //Content
			        $mail->isHTML(true);                                  
			        $mail->Subject = $subject;
			        $mail->Body    = $message;

			        $mail->send();
					$_SESSION['success'] = "Email sent successfully!";
					header("Location: contact-us.php");

			    } catch (Exception $e) {
			    	$_SESSION['success'] = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
					header("Location: contact-us.php");
			    }
    }
	

?>



