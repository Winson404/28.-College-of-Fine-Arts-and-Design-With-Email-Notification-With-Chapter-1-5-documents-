<?php 
	include '../config.php';

	// DELETE ADMIN - ADMIN_DELETE.PHP
	if(isset($_POST['delete_admin'])) {
		$user_Id = $_POST['user_Id'];

		$delete = mysqli_query($conn, "DELETE FROM users WHERE user_Id='$user_Id'");
		if($delete) {
	      	$_SESSION['message'] = "System user has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: admin.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: admin.php");
	      }
	}


	// DELETE USER - USERS_DELETE.PHP
	if(isset($_POST['delete_user'])) {
		$user_Id = $_POST['user_Id'];

		$delete = mysqli_query($conn, "DELETE FROM users WHERE user_Id='$user_Id'");
		if($delete) {
	      	$_SESSION['message'] = "Buyer record has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: users.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: users.php");
	      }
	}



	// DELETE SELLER - SELLER_DELETE.PHP
	if(isset($_POST['delete_seller'])) {
		$user_Id = $_POST['user_Id'];

		$delete = mysqli_query($conn, "DELETE FROM users WHERE user_Id='$user_Id'");
		if($delete) {
	      	$_SESSION['message'] = "Seller record has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: seller.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: seller.php");
	      }
	}
	

	// DELETE CUSTOMIZATION - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['delete_customization'])) {
		$customID = $_POST['customID'];

		$delete = mysqli_query($conn, "DELETE FROM customization WHERE customID='$customID'");
		 if($delete) {
	      	$_SESSION['message'] = "Website settings has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: customize.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: customize.php");
	      }
	}


	// DELETE ACTIVITY - ACTIVITY_UPDATE_DELETE.PHP
	if(isset($_POST['delete_activity'])) {
		$actId = $_POST['actId'];

		$delete = mysqli_query($conn, "DELETE FROM announcement WHERE actId='$actId'");
		 if($delete) {
	      	$_SESSION['message'] = "Announcement has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: announcement.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: announcement.php");
	      }
	}




	// DELETE CATEGORY - CATERGORY_UPDATE_DELETE.PHP
	if(isset($_POST['delete_category'])) {
		$cat_id = $_POST['cat_id'];
		$delete = mysqli_query($conn, "DELETE FROM category WHERE cat_id='$cat_id'");
		 if($delete) {
	      	$_SESSION['message'] = "Category has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: category.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: category.php");
	      }
	}





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




