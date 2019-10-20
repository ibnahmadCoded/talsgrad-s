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

	$get_bazaar = "SELECT * FROM bazaar WHERE post_id='$post_id' AND user_id= '$user_id'";
	$run_bazaar = mysqli_query($con, $get_bazaar);
	$row_bazaar = mysqli_fetch_array($run_bazaar);

	$bazaar_id = $row_bazaar['baz_id'];

	$delete_from_bazaar ="DELETE FROM bazaar WHERE baz_id='$bazaar_id'";
	$run_delete = mysqli_query($con, $delete_from_bazaar);

	$update_in_posts = "UPDATE posts SET bazaar = 'no' WHERE post_id='$post_id'";
	$run_update = mysqli_query($con, $update_in_posts);

	if($run_delete && $run_update){

		//notify
		$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_id', '$user_id', '$post_id', 'rembazaar', 'unread', NOW())";

		$run_notify = mysqli_query($con, $notify);

		if($run_notify){

			header("HTTP/1.0 204 No Content"); //don't refresh page!
			#echo "<script>window.open('../profile.php?u5Nm=$user_name', '_self')</script>";

		}
	}
}


 ?>