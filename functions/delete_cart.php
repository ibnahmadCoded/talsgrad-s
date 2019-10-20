<?php 
$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

if(isset($_GET['cart_id'])){
	$cart_id = $_GET['cart_id'];

	$get_user = "SELECT * FROM cart WHERE cart_id = '$cart_id'";
	$run_user = mysqli_query($con, $get_user);
	$row_user = mysqli_fetch_array($run_user);
	$user_id = $row_user['user_id'];

	$get_uname = "SELECT user_name FROM users WHERE user_id = '$user_id'";
	$run_uname = mysqli_query($con, $get_uname);
	$row_uname = mysqli_fetch_array($run_uname);
	$user_name = $row_uname['user_name'];

	$delete_cart ="DELETE FROM cart WHERE cart_id='$cart_id'";
	$run_delete = mysqli_query($con, $delete_cart);

	if($run_delete){
		#echo "<script>alert('The item has been deleted')</script>";

		header("HTTP/1.0 204 No Content"); //don't refresh page!
		#echo "<script>window.open('../cart.php?u5Nm=$user_name', '_self')</script>";
	}
}


 ?>