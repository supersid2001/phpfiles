<?php
	$con = mysqli_connect("db4free.net", 'supersid2001','Idareyou2468', 'rockpaperscissor');
	//check connection
	if(mysqli_connect_errno())
	{
		echo "1 : Connection failed"; //Error occured 
		exit();
	}
	$username = $_POST["username"];
	$string = $_POST["ratings"];
	$json = array(
		'num_ratings' => $existinginfo['num_ratings'],
		'total_rating' => $existinginfo['total_rating'],
		'avg_rating' => $existinginfo['avg_rating'],
		'likes' => $existinginfo['likes'], 
		'dislikes' => $existinginfo['dislikes'],
		'dislikes_exp' => $existinginfo['dislikes_exp'],
		'bugs' => $existinginfo['bugs'],
		'comments' => $existinginfo['comments']);
	$json = json_decode($string);
	$namecheckquery = "SELECT username FROM ratings WHERE username = '" .  $username . "'; ";
	$namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed");
	if(mysqli_num_rows($namecheck != 1))
	{
		echo "5: Either no user with name or more than one user with name";
		exit();
	}
	$updatequery = "UPDATE players SET num_ratings = " . $json['num_ratings'] ." , total_rating = " . $json['total_rating'] ." , avg_rating = " . $json['avg_rating'] ." , likes = '" . $json['likes'] ."', dislikes = '" . $json['dislikes'] ."', dislikes_ exp = '" . $json['dislikes_exp'] ."', bugs = '" . $json['bugs'] ."', comments = '" . $json['comments'] ."' WHERE username = '" . $username ."';";
	mysqli_query($con, $updatequery) or die(mysqli_error($con));
	echo "0";
?>