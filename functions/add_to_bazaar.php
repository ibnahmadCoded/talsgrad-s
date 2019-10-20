<?php 
$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

if(isset($_GET['post_id'])){
	$post_id = $_GET['post_id'];

	$get_posts = "SELECT * FROM posts WHERE post_id='$post_id'";
	$run_posts = mysqli_query($con, $get_posts);
	$row_posts = mysqli_fetch_array($run_posts);

	$user_id = $row_posts['user_id'];
	
	$get_username = "SELECT user_name from users where user_id = '$user_id'";
	$run_name = mysqli_query($con, $get_username);
	$row_name = mysqli_fetch_array($run_name);
	$user_name = $row_name['user_name'];

	$insert_bazaar = "INSERT INTO bazaar (post_id, user_id, price, date) VALUES ('$post_id', '$user_id', 'not given', NOW())";
	$run_bazaar = mysqli_query($con, $insert_bazaar);
	

	$update_in_posts = "UPDATE posts SET bazaar = 'yes' WHERE post_id='$post_id'";
	$run_update = mysqli_query($con, $update_in_posts);

	if($run_bazaar && $run_update){

		//notify
		$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_id', '$user_id', '$post_id', 'addbazaar', 'unread', NOW())";

		$run_notify = mysqli_query($con, $notify);

		if($run_notify){

			header("HTTP/1.0 204 No Content"); //don't refresh page!

			#echo "<script>window.open('../profile.php?u5Nm=$user_name', '_self')</script>";

		}
	}
}

 ?>