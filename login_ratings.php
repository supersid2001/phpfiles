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

	$namecheckquery = "SELECT username, hash, salt, num_ratings, total_rating, avg_rating, likes, dislikes, dislikes_exp, bugs, comments FROM ratings WHERE username = '" .  $username . "'; ";
	$namecheck = mysqli_query($con, $namecheckquery) or die(mysqli_error($con));//error code 2 namecheck failed
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
		'num_ratings' => $existinginfo['num_ratings'],
		'total_rating' => $existinginfo['total_rating'],
		'avg_rating' => $existinginfo['avg_rating'],
		'likes' => $existinginfo['likes'], 
		'dislikes' => $existinginfo['dislikes'],
		'dislikes_exp' => $existinginfo['dislikes_exp'],
		'bugs' => $existinginfo['bugs'],
		'comments' => $existinginfo['comments']);


	echo "0\t" . json_encode($json);

?>