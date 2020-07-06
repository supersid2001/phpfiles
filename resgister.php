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
	$namecheckquery = "SELECT username  FROM players WHERE username = '" .  $username . "'; ";
	$namecheck = mysqli_query($con, $namecheckquery) or die("2 : Namecheck failed");//error code 2 namecheck failed

	if(mysqli_num_rows($namecheck) > 0)
	{
		echo "3: Username already exists";
		exit();
	}

	//add user to table 
	$salt =  "\$5\$rounds=1000\$" . "batcomputer" . $username . "\$";
	$hash = crypt($password, $salt);
	mysqli_query($con, "INSERT INTO players ( `username`, `hash`, `salt`) VALUES ('" .$username ."', '" .$hash ."', '" .$salt ."');") or die(mysqli_error($con));
	echo("0");


?>