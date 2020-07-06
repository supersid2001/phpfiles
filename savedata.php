<?php
	$con = mysqli_connect("db4free.net", 'supersid2001','Idareyou2468', 'rockpaperscissor');
	//check connection
	if(mysqli_connect_errno())
	{
		echo "1 : Connection failed"; //Error occured 
		exit();
	}
	$username = $_POST["name"];
	$num_games = $_POST["num_games"];
	$num_wins = $_POST["num_wins"];
	$num_losses = $_POST["num_losses"];
	$num_draws = $_POST["num_draws"];
	$ratings = $_POST["rating"];
	$num_ratings = $_POST["num_ratings"];
	$avg_ratings = $_POST["avg_ratings"];

	$namecheckquery = "SELECT username FROM players WHERE username = '" .  $username . "'; ";
	$namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed");
	if(mysqli_num_rows($namecheck != 1))
	{
		echo "5: Either no user with name or more than one user with name";
		exit();
	}
	$updatequery = "UPDATE players SET num_games = " .$num_games ." , num_wins =  ". $num_wins .", num_losses = " . $num_losses .", num_draws = " . $num_draws . ", Rating = ". $ratings . " , num_ratings = ". $num_ratings . ", avg_rating = ". $avg_ratings ." WHERE username = '" . $username ."';";
	mysqli_query($con, $updatequery) or die(mysqli_error($con));
	echo "0";


?>