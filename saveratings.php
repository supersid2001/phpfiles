<?php
	$con = mysqli_connect("db4free.net", 'supersid2001','Idareyou2468', 'rockpaperscissor');
	//check connection
	if(mysqli_connect_errno())
	{
		echo "1 : Connection failed"; //Error occured 
		exit();
	}
	$username = $_POST["username"];
	$num_ratings = $_POST["num_ratings"];
	$total_ratings = $_POST["total_ratings"];
	$avg_ratings = $_POST["avg_ratings"];
	$likes = $_POST["likes"];
	$dislikes = $_POST["dislikes"];
	$dislikes_exp = $_POST["dislikes_exp"];
	$bugs = $_POST["bugs"];
	$avg_ratings = $_POST["comments"];

	$namecheckquery = "SELECT username FROM ratings WHERE username = '" .  $username . "'; ";
	$namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed");
	if(mysqli_num_rows($namecheck != 1))
	{
		echo "5: Either no user with name or more than one user with name";
		exit();
	}
	$updatequery = "UPDATE players SET num_ratings = " . $num_ratings ." , total_rating = " . $total_rating ." , avg_rating = " . $avg_ratings ." , likes = '" . $likes ."', dislikes = '" . $dislikes ."', dislikes_exp = '" . $dislikes_exp ."', bugs = '" . $bugs ."', comments = '" . $comments ."' WHERE username = '" . $username ."';";
	mysqli_query($con, $updatequery) or die(mysqli_error($con));
	echo "0";
?>