<?php 
	session_start();
	$conn = mysqli_connect("localhost","root","","artbid");
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	date_default_timezone_set('Asia/Manila');

	// get current date and time
    $date_today = date('Y-m-d H:i:s');

    // get yesterday's date
	$yesterday_date = date('Y-m-d', strtotime('-1 day'));


	// WEBSITE SETTINGS
	$getActive = mysqli_query($conn, "SELECT * FROM customization WHERE status=1");
	$settings_name    = "";
	$settings_about   = "";
	$settings_mission = "";
	$settings_vision  = "";
	$settings_contact = "";
	$settings_email   = "";
	if(mysqli_num_rows($getActive) > 0) {
		$ActiveSettings   = mysqli_fetch_array($getActive);
		$settings_name    = $ActiveSettings['brandName'];
		$settings_about   = $ActiveSettings['about'];
		$settings_mission = $ActiveSettings['mission'];
		$settings_vision  = $ActiveSettings['vision'];
		$settings_contact = $ActiveSettings['contact'];
		$settings_email   = $ActiveSettings['email'];
	} else {
		$settings_name    = "ArtBid";
		$settings_about   = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere cupiditate delectus laborum laudantium autem ea temporibus voluptatibus iusto aliquam recusandae repellat vel ipsum, ex obcaecati corrupti, voluptas aliquid hic aspernatur?";
		$settings_mission = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere cupiditate delectus laborum laudantium autem ea temporibus voluptatibus iusto aliquam recusandae repellat vel ipsum, ex obcaecati corrupti, voluptas aliquid hic aspernatur?";
		$settings_vision  = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere cupiditate delectus laborum laudantium autem ea temporibus voluptatibus iusto aliquam recusandae repellat vel ipsum, ex obcaecati corrupti, voluptas aliquid hic aspernatur?";
		$settings_contact = "9359428963";
		$settings_email   = "admin@gmail.com";
	}


	
?>