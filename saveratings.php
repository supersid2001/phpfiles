<?php
	$con = mysqli_connect("db4free.net", 'supersid2001','Idareyou2468', 'rockpaperscissor');
	//check connection
	if(mysqli_connect_errno())
	{
		echo "1 : Connection failed"; //Error occured 
		exit();
	}
	$string = $_POST["ratings"];
	$json = array(
		'id' => 0,
		'rating' => 0,
		'likes' => "", 
		'dislikes' => "",
		'dislikes_exp' => "",
		'bugs' => "",
		'comments' => "",
		'recommended' => 0,
		'feedback_type' => 0,
    	'meeting_id' => null,
    	'version' => "2.9.1");
	$json = json_decode($string, true) or die(mysqli_error($con));
	$meetingid = 0;
	if($json['meeting_id'] != null)
	{
		$idcheckquery = "SELECT id FROM meetings WHERE Meeting_id = '" .  $json['meeting_id'] . "'; ";
		$idcheck = mysqli_query($con, $idcheckquery) or die("9 : idcheck failed");//error code 2 
		$meetingid = mysqli_fetch_assoc($idcheck);
	}
	mysqli_query($con, "INSERT INTO ratings (`userid`, `rating`, `likes`, `dislikes`, `dislikes_exp`, `bugs`, `comments`, `Recommend`, `feedback_type`, `meeting_id`, `version`) VALUES ('". $json['id'] ."', " . $json['rating'] .", '" .$json['likes'] ."', '" . $json['dislikes'] ."', '". $json['dislikes_exp'] ."', '". $json['bugs'] ."', '". $json['comments'] ."', ". $json['recommended'] .", ". $json['feedback_type'] .", '" . $meetingid ."', '". $json['version'] ."');") or die(mysqli_error($con));
	echo "0";
?>