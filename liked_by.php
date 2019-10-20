<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){

	session_destroy();
	
	header("location: index.php");
}

if(isset($_SESSION['user_email'])){

	$email = $_SESSION['user_email'];
}

$update_activity = "UPDATE users SET last_activity = NOW() WHERE email = '$email'";
$run_update = mysqli_query($con, $update_activity);

?>
<html>
<head>
	<title>Likes</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	<style>

	#show_likes{
	background: #fff;
		box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		border-radius: 30px 30px 30px 30px;
		padding: 40px 50px;
}
	</style>
</head>
<body>
<div class="row">
	<div class="col-sm-12">

		<?php 

			if(isset($_GET['liK34Di'])){

			$post_id = $_GET['liK34Di'];


		}

		 ?>
		<center><h2>Item Likes</h2></center><br><br>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
			</div>
		</div><br><br>
		<?php 

		if(isset($_GET['liK34Di'])){

		$get_likes = "SELECT * FROM likes WHERE post_id = '$post_id'";


		$run_likes = mysqli_query($con, $get_likes); 

		while($row_likes = mysqli_fetch_array($run_likes)){

			$like_user = $row_likes['user_id'];

			$get_likedby =  "SELECT * FROM users WHERE user_id='$like_user'";

			$run_likedby = mysqli_query($con, $get_likedby);

			$row_likedby = mysqli_fetch_array($run_likedby);

			$liked_fname = $row_likedby['f_name'];
			$liked_lname = $row_likedby['l_name'];
			$liked_uname = $row_likedby['user_name'];
			$liked_image = $row_likedby['user_image'];



				echo "
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div class='col-sm-6'>
							<div class='row' id='show_likes'>
								<div class='col-sm-4'>
									<img src='users/$liked_image' width='150px' height='140px' title='$liked_uname' style='float:left; margin:1px;'/>
									</a>
								</div><br><br>
								<div class='col-sm-6'>
									<a style='text-decoration:none; cursor:pointer; color:#fd4720;' href='user_profile.php?u5Nm=$liked_uname'>
									<strong><h2>$liked_fname $liked_lname</h2></strong>
									</a>
								</div>
								<div class='col-sm-3'>
								</div>
							</div>
							<div class='col-sm-4'>
							</div>
						</div><br>
					</div>
				";

		}
	}

		 ?>
	</div>
</div>
</body>
</html>