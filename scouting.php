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
	<title>Scouting</title>
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
		<center><h2>People <?php echo "$first_name $last_name"; ?> is Scouting</h2></center><br><br>
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
			</div>
		</div><br><br>
		<?php 

		$get_following = "SELECT * FROM follow WHERE follower_id = '$user_id'";


		$run_following = mysqli_query($con, $get_following); 

		while($row_following = mysqli_fetch_array($run_following)){

			$scouted_user = $row_following['followed_id'];

			$get_scouted =  "SELECT * FROM users WHERE user_id='$scouted_user'";

			$run_scouted = mysqli_query($con, $get_scouted);

			$row_scouted = mysqli_fetch_array($run_scouted);

			$scouted_fname = $row_scouted['f_name'];
			$scouted_lname = $row_scouted['l_name'];
			$scouted_uname = $row_scouted['user_name'];
			$scouted_image = $row_scouted['user_image'];

			if($user_id != $scouted_user){

				echo "
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div class='col-sm-6'>
							<div class='row' id='show_scouting'>
								<div class='col-sm-4'>
									<img src='users/$scouted_image' width='150px' height='140px' title='$scouted_uname' style='float:left; margin:1px;'/>
									</a>
								</div><br><br>
								<div class='col-sm-6'>
									<a style='text-decoration:none; cursor:pointer; color:#fd4720;' href='user_profile.php?u5Nm=$scouted_uname'>
									<strong><h2>$scouted_fname $scouted_lname</h2></strong>
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