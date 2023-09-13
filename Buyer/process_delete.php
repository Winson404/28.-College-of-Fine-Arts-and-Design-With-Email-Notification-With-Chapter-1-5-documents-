<?php 
	include '../config.php';


	// DELETE ADMIN - ADMIN_DELETE.PHP
	if(isset($_POST['delete_Bidding'])) {
		$bidding_Id = $_POST['bidding_Id'];

		$delete = mysqli_query($conn, "DELETE FROM bidding WHERE bidding_Id='$bidding_Id'");
		if($delete) {
			$_SESSION['message'] = "Bidding has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: transactions.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: transactions.php");
	      }
	}



?>




