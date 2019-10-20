<?php 
include("includes/connection.php");
session_start();

if(isset($_GET['url'], $_GET['user_from'], $_GET['user_to'])){

	$url = $_GET['url'];
	$user_from_msg = (int)$_GET['user_from'];
	$user_id = (int)$_GET['user_to'];


				
	$update = "UPDATE user_messages SET msg_seen = 'yes' WHERE (user_to='$user_id' AND user_from='$user_from_msg') OR (user_from='$user_id' AND user_to='$user_from_msg')";
	$run_update = mysqli_query($con, $update);

	if($run_update){

		echo "<script>window.open('$url', '_self')</script>";

	}else{

		echo "Error 404";
	}

}



 ?>	





		
