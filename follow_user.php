<?php 
include("includes/connection.php");
session_start();

if(isset($_GET['u5Nm'])){
	$u_name = $_GET['u5Nm'];

	$get_u_id = "SELECT user_id FROM users WHERE user_name = '$u_name'";
	$run_get_u_id = mysqli_query($con, $get_u_id);
	$row_u_id = mysqli_fetch_array($run_get_u_id);

	$followed_id = $row_u_id['user_id'];

	#$followed_id = $_GET['u_id'];

	global $con;

	$get_followeduname = "SELECT user_name FROM users WHERE user_id = $followed_id";
	$run_name = mysqli_query($con, $get_followeduname);
	$row_name = mysqli_fetch_array($run_name);

	$user_name = $row_name['user_name'];


	$user = $_SESSION['user_email'];
	$get_user = "select * from users where email='$user'";
	$run_user = mysqli_query($con,$get_user);
	$row = mysqli_fetch_array($run_user);

	$follower_id = $row['user_id'];

	$insert = "INSERT INTO follow (follower_id, followed_id, date) VALUES ('$follower_id','$followed_id', NOW())";

	$run_insert = mysqli_query($con, $insert);

	if($run_insert){

		//notify
		$insert_notification = "INSERT INTO notifications (user_from_id, user_to_id, other_id, type, status, date) VALUES ('$follower_id','$followed_id', '$follower_id', 'follow', 'unread', NOW())";
		$run_insert1 = mysqli_query($con, $insert_notification);

		echo "<script>window.open('user_profile.php?u5Nm=$user_name', '_self')</script>"; }


}

 ?>