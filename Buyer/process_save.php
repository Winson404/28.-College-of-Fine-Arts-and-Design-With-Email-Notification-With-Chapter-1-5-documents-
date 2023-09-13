<?php 
	include '../config.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../vendor/PHPMailer/src/Exception.php';
	require '../vendor/PHPMailer/src/PHPMailer.php';
	require '../vendor/PHPMailer/src/SMTP.php';
	date_default_timezone_set('Asia/Manila');


	// ADD BIDDING
	if(isset($_POST['add_bidding'])) {
		$user_Id	   = $_POST['user_Id'];
		$product_Id    = $_POST['product_Id'];
		$bidding_price = $_POST['bidding_price'];

		// $exist = mysqli_query($conn, "SELECT * FROM bidding WHERE user_Id='$user_Id' AND product_Id='$product_Id'");
		// if(mysqli_num_rows($exist) > 0) {

		// 	$sql = mysqli_query($conn, "SELECT *, MAX(bidding_price) AS highest FROM bidding WHERE product_Id='$product_Id'");
		// 	$high = mysqli_fetch_array($sql);
		// 	$max = $high['highest'];

		// 	if($bidding_price <= $max) {
		// 		$_SESSION['message'] = "You must bid higher than ".$max;
		//         $_SESSION['text'] = "Please try again.";
		//         $_SESSION['status'] = "error";
		// 		header("Location: index.php");
		// 	} else {
		// 	   $update = mysqli_query($conn, "UPDATE bidding SET bidding_price='$bidding_price' WHERE user_Id='$user_Id' AND product_Id='$product_Id'");
		// 	   if($update) {
		//        	$_SESSION['message'] = "You are now the highest bidder of your selected product";
		//          $_SESSION['text'] = "Saved successfully!";
		//          $_SESSION['status'] = "success";
		// 	 	header("Location: index.php");
		//        } else {
		//          $_SESSION['message'] = "Something went wrong while.";
		//          $_SESSION['text'] = "Please try again.";
		//          $_SESSION['status'] = "error";
		// 	 	header("Location: index.php");
		//        }
		// 	}
		// } else {
			$sql = mysqli_query($conn, "SELECT *, MAX(bidding_price) AS highest FROM bidding WHERE product_Id='$product_Id'");
			$high = mysqli_fetch_array($sql);
			$max = $high['highest'];

			if($bidding_price <= $max) {
				$_SESSION['message'] = "You must bid higher than ".$max;
		        $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: index.php");
			} else {
			   $save = mysqli_query($conn, "INSERT INTO bidding (user_Id, product_Id, bidding_price) VALUES ('$user_Id', '$product_Id', '$bidding_price')");
			   if($save) {
		       	 $_SESSION['message'] = "You have added your bidding price successfully.";
		         $_SESSION['text'] = "Saved successfully!";
		         $_SESSION['status'] = "success";
				 header("Location: index.php");
		       } else {
		         $_SESSION['message'] = "Something went wrong while.";
		         $_SESSION['text'] = "Please try again.";
		         $_SESSION['status'] = "error";
				 header("Location: index.php");
		       }
			}
		// }
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





	// GET BIDDING STATUS AUTOMATICALLY - DASHBOARD.PHP
	if(isset($_POST['getStatus']) && isset($_POST['user_Id'])) {
		$user_Id = $_POST['user_Id'];
		$productId = $_POST['getStatus'];

		$fetch = mysqli_query($conn, "SELECT bidding_Id, product_Id, bidding_status FROM bidding WHERE user_Id = '$user_Id'");

		$biddingStatuses = array();
		while ($row = $fetch->fetch_assoc()) {
		  $biddingStatuses[$row['product_Id']] = $row['bidding_status'];
		}

		// Return the bidding statuses as JSON
		echo json_encode($biddingStatuses);
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



