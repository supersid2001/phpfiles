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
		'username' => null,
		'rating' => 0,
		'likes' => "", 
		'dislikes' => "",
		'dislikes_exp' => "",
		'bugs' => "",
		'comments' => "",
		'recommended' => 0,
		'feedback_type' => 0,
    	'meeting_id' => 0,
    	'version' => "2.9.1");
	$json = json_decode($string, true) or die(mysqli_error($con));
	mysqli_query($con, "INSERT INTO ratings (`username`, `rating`, `likes`, `dislikes`, `dislikes_exp`, `bugs`, `comments`, `Recommend`, `feedback_type`, `meeting_id`, `version`) VALUES ('". $json['username'] ."', " . $json['rating'] .", '" .$json['likes'] ."', '" . $json['dislikes'] ."', '". $json['dislikes_exp'] ."', '". $json['bugs'] ."', '". $json['comments'] ."', '". $json['recommended'] ."', ". $json['feedback_type'] .", " . $json['meeting_id'] .", '". $json['version'] ."');") or die(mysqli_error($con));
	echo "0";
?>