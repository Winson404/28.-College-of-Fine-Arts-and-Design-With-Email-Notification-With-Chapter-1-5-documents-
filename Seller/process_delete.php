<?php 

	include '../config.php';

	// DELETE PRODUCT - PRODUCT_DELETE.PHP
	if(isset($_POST['delete_product'])) {
		$product_Id = $_POST['product_Id'];
		$delete = mysqli_query($conn, "DELETE FROM product WHERE product_Id='$product_Id'");
		 if($delete) {
	      	$_SESSION['message'] = "Product has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: product.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: product.php");
	      }
	}


?>





