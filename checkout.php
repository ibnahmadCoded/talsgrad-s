<?php 
$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

if(isset($_GET['u5Nm'], $_GET['items'])){
	$u_name = $_GET['u5Nm'];
	$number = $_GET['items'];

	$get_u_id = "SELECT user_id FROM users WHERE user_name = '$u_name'";
	$run_get_u_id = mysqli_query($con, $get_u_id);
	$row_u_id = mysqli_fetch_array($run_get_u_id);

	$u_id = $row_u_id['user_id'];

	$get_cart = "SELECT * FROM cart WHERE user_id='$u_id'";
	$run_cart = mysqli_query($con, $get_cart);

	$match  = mysqli_num_rows($run_cart);

	while($row_cart = mysqli_fetch_array($run_cart)){

		$cart_id = $row_cart['cart_id'];
		$user_id = $row_cart['user_id'];
		$post_id = $row_cart['post_id'];
		$owner_id = $row_cart['owner_id'];
		$date_checked = $row_cart['date'];

		if($number == $match){
			//send message talsgrad bazaar accct

			$talsgrad_bazaar = $owner_id;

			$msg = '
						 
				I checked out your item http://www.talsgrad.com/single.php?post_id='.$post_id.' on bazaar.
						 
				Please reply to ensure the sales is completed.
						 
				';

			$insert = "insert into user_messages(user_to, user_from, msg_body, date, msg_seen) values ('$talsgrad_bazaar', '$user_id', '$msg', NOW(), 'no')";

			$run_insert = mysqli_query($con, $insert);


			$insert_record = "INSERT INTO sales (owner_id, user_id, post_id, date_checked, date_confirmed) VALUES ('$owner_id','$user_id', '$post_id', '$date_checked', NOW())";
			$run_insert = mysqli_query($con, $insert_record); //insert record into db for fututre reference!

			if($run_insert){

				//notify

				$insert_notification = "INSERT INTO notifications (user_from_id, user_to_id, other_id, type, status, date) VALUES ('$user_id','$user_id', '$post_id', 'checkout', 'unread', NOW())";
				$run_insert1 = mysqli_query($con, $insert_notification);

				//notify item owner too!
				$insert_notification2 = "INSERT INTO notifications (user_from_id, user_to_id, other_id, type, status, date) VALUES ('$user_id','$owner_id', '$post_id', 'checkout', 'unread', NOW())";
				$run_insert2 = mysqli_query($con, $insert_notification2);


				$delete_cart ="DELETE FROM cart WHERE cart_id='$cart_id'"; //delete items from cart

				$run_delete = mysqli_query($con, $delete_cart);

				if($run_delete){
				echo "<script>window.open('cart.php?u5Nm=$u_name', '_self')</script>";
				}
			}
		}
		else { //the numbers don't match
			echo "<script>alert('error 404')</script>";
			echo "<script>window.open('cart.php?u5Nm=$u_name', '_self')</script>";
		}
	}
}


 ?>