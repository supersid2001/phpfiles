<?php
	$con = mysqli_connect("db4free.net", 'supersid2001','Idareyou2468', 'rockpaperscissor');
	//check connection
	if(mysqli_connect_errno())
	{
		echo "1 : Connection failed"; //Error occured 
		exit();
	}
	$username = $_POST["name"];
	$rating_json = $_POST["Ratings"]

	$namecheckquery = "SELECT username FROM ratings WHERE username = '" .  $username . "'; ";
	$namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed");
	if(mysqli_num_rows($namecheck != 1))
	{
		echo "5: Either no user with name or more than one user with name";
		exit();
	}
	$updatequery = "UPDATE players SET ratings = " . $rating_json ." WHERE username = '" . $username ."';";
	mysqli_query($con, $updatequery) or die(mysqli_error($con));
	echo "0";
?>