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
	<title>Scouted By</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	<style>

	#show_scouting{
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

			if(isset($_GET['u5Nm'])){

			$u_name = $_GET['u5Nm'];
			
			$get_user = "SELECT * FROM users WHERE user_name = '$u_name'";

			$run_user = mysqli_query($con, $get_user);
			$row_user = mysqli_fetch_array($run_user);

			$first_name = $row_user['f_name'];
			$last_name = $row_user['l_name'];
			$user_id = $row_user['user_id'];


		}

		 ?>
		 
		<center><h2>People Scouting <?php echo "$first_name $last_name"; ?></h2></center><br><br>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
			</div>
		</div><br><br>
		<?php 

		$get_followers = "SELECT * FROM follow WHERE followed_id = '$user_id'";
		$run_followers = mysqli_query($con, $get_followers); 

		while($row_followers = mysqli_fetch_array($run_followers)){

			$scouting_user = $row_followers['follower_id'];

			$get_scouting =  "SELECT * FROM users WHERE user_id='$scouting_user'";

			$run_scouting = mysqli_query($con, $get_scouting);

			$row_scouting = mysqli_fetch_array($run_scouting);

			$scouting_fname = $row_scouting['f_name'];
			$scouting_lname = $row_scouting['l_name'];
			$scouting_uname = $row_scouting['user_name'];
			$scouting_image = $row_scouting['user_image'];

			if($user_id != $scouting_user){

				echo "
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div class='col-sm-6'>
							<div class='row' id='show_scouting'>
								<div class='col-sm-4'>
									<img src='users/$scouting_image' width='150px' height='140px' title='$scouting_uname' style='float:left; margin:1px;'/>
									</a>
								</div><br><br>
								<div class='col-sm-6'>
									<a style='text-decoration:none; cursor:pointer; color:#fd4720;' href='user_profile.php?u5Nm=$scouting_uname'>
									<strong><h2>$scouting_fname $scouting_lname</h2></strong>
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