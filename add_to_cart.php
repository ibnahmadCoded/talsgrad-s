<?php 
include("includes/connection.php");
session_start();
if(!isset($_SESSION['user_email'])){

    session_destroy();
    
    header("location: index.php");
}

if(isset($_SESSION['user_email'])){

	$email = $_SESSION['user_email'];
}

$update_activity = "UPDATE users SET last_activity = NOW() WHERE email = '$email'";
$run_update = mysqli_query($con, $update_activity);

if(isset($_GET['post_id'])){

	$post_id = (int)$_GET['post_id'];

	global $con;


		$user = $_SESSION['user_email'];
		$get_user = "select * from users where email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_id = $row['user_id'];
		$user_name = $row['user_name'];

		$get_post = "SELECT * from posts WHERE post_id=$post_id";
		$run_post = mysqli_query($con, $get_post);
		$row_post = mysqli_fetch_array($run_post);

		$owner_id = $row_post['user_id'];

		$search_cart = "SELECT * FROM cart WHERE user_id='$user_id' AND post_id = '$post_id'";
		$run_search = mysqli_query($con, $search_cart);


		$match  = mysqli_num_rows($run_search);

		if($match>0){ //product already present in cart.

			header("HTTP/1.0 204 No Content"); //don't refresh page!
			#echo "<script>window.open('bazaar.php?u5Nm=$user_name', '_self')</script>"; 
			
		}
		else{

			$insert_cart = "INSERT INTO cart (owner_id, user_id, post_id, date) VALUES ('$owner_id', '$user_id', '$post_id', NOW())";
			$run_insert_cart = mysqli_query($con, $insert_cart);

			header("HTTP/1.0 204 No Content");
			#echo "<script>window.open('bazaar.php?u5Nm=$user_name', '_self')</script>";
		}
	
}


 ?>