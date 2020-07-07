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

	$namecheckquery = "SELECT username, salt, hash, num_games, num_wins, num_losses, num_draws, Rating, num_ratings FROM players WHERE username = '" .  $username . "'; ";
	$namecheck = mysqli_query($con, $namecheckquery) or die("2 : Namecheck failed");//error code 2 namecheck failed
	if(mysqli_num_rows($namecheck != 1))
	{
		echo "5: Either no user with name or more than one user with name";
		exit();
	}

	//Get and check login info from query
	$existinginfo = mysqli_fetch_assoc($namecheck);
	$salt = $existinginfo["salt"];
	$hash = $existinginfo["hash"];

	$loginhash = crypt($password, $salt);
	if($hash != $loginhash)
	{
		echo "6: Invalid credentials";
		exit();
	}
	$json = array(
		'games' => $existinginfo['num_games'],
		'wins' => $existinginfo['num_wins'],
		 'losses' => $existinginfo['num_losses'],
		 'draws' => $existinginfo['num_draws'], 
		  'ratings' => $existinginfo['Rating'],
			'num_ratings' => $existinginfo['num_ratings']);

	echo "0\t" . json_encode($json);


?>