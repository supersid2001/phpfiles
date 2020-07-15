<?php
	$con = mysqli_connect("db4free.net", 'supersid2001','Idareyou2468', 'rockpaperscissor');
	//check connection
	if(mysqli_connect_errno())
	{
		echo "1 : Connection failed"; //Error occured 
		exit();
	}

	$username = $_POST["username"];
	$password = $_POST["password"];

	//Check if name has been taken by another user
	$namecheckquery = "SELECT username  FROM ratings WHERE username = '" .  $username . "'; ";
	$namecheck = mysqli_query($con, $namecheckquery) or die("2 : Namecheck failed");//error code 2 namecheck failed

	if(mysqli_num_rows($namecheck) > 0)
	{
		echo "3: Username already exists";
		exit();
	}
	$json = array(
		'num_ratings' => 0,
		'total_rating' => 0,
		'avg_rating' => 0,
		'likes' => "", 
		'dislikes' => "",
		'dislikes_exp' => "",
		'bugs' => "",
		'comments' => "");
	//add user to table 
	$salt =  "\$5\$rounds=1000\$" . "batcomputer" . $username . "\$";
	$hash = crypt($password, $salt);
	mysqli_query($con, "INSERT INTO ratings ( `username`, `hash`, `salt`, `ratings`) VALUES ('" .$username ."', '" .$hash ."', '" .$salt ."', '". json_encode($json) ."');") or die(mysqli_error($con));
	echo("0");


?>