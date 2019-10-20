<?php 
$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

if(isset($_GET['post_id'])){
	$post_id = $_GET['post_id'];

	//get_user
	$get_user = "select * from posts where post_id ='$post_id'";
	$run_user = mysqli_query($con, $get_user);
	$row = mysqli_fetch_array($run_user);

	$user_id = $row['user_id'];

	$get_uname = "SELECT user_name FROM users WHERE user_id = '$user_id'";
	$run_uname = mysqli_query($con, $get_uname);
	$row_uname = mysqli_fetch_array($run_uname);

	$user_name = $row_uname['user_name'];


	$delete_post ="DELETE FROM posts WHERE post_id='$post_id'";

	$run_delete = mysqli_query($con, $delete_post);

	if($run_delete){

		//notify
		$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_id', '$user_id', '', 'delpost', 'unread', NOW())";

		$run_notify = mysqli_query($con, $notify);

		if($run_notify){
			
			header("HTTP/1.0 204 No Content"); //don't refresh page!
			#echo "<script>window.open('../profile.php?u5Nm=$user_name', '_self')</script>";
		}
	}
}


 ?>