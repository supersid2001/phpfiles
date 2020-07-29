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
    	'version' => "2.9.1",
    	'Platform' => "Windows");
	$json = json_decode($string, true) or die(mysqli_error($con));
	$meetingid = 
	array(
		'id'=> 0
	);
	if($json['meeting_id'] != null)
	{
		$idcheckquery = "SELECT id FROM Meetings WHERE Meeting_id = '" .  $json['meeting_id'] . "'; ";
		$idcheck = mysqli_query($con, $idcheckquery) or die(mysqli_error($con));//error code 2 
		$meetingid = mysqli_fetch_assoc($idcheck);
	}
	else 
	{
		$meetingid['id'] = 0;
	}
	mysqli_query($con, "INSERT INTO ratings (`userid`, `rating`, `likes`, `dislikes`, `dislikes_exp`, `bugs`, `comments`, `Recommend`, `feedback_type`, `meeting_id`, `version`, `platform`) VALUES ('". $json['username'] ."', " . $json['rating'] .", '" .$json['likes'] ."', '" . $json['dislikes'] ."', '". $json['dislikes_exp'] ."', '". $json['bugs'] ."', '". $json['comments'] ."', ". $json['recommended'] .", ". $json['feedback_type'] .", '" . $meetingid['id'] ."', '". $json['version'] ."', '". $json['platform'] ."');") or die(mysqli_error($con));
	echo "0";
?>