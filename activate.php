<!DOCTYPE html>
<html>
<head>
	<title>Talsgrad: Verify Account</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
	body{
		overflow-x: hidden;
	}
	.main-content{
		width: 50%;
		height: 40%;
		margin: 10px auto;
		background: #fff;
		box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		border-radius: 30px 30px 30px 30px;
		padding: 40px 50px;
	}
	.header{
		border: 0px solid #000;
		margin-bottom: 5px;
	}
	.well{
		background-color: #fd4720;
	}
	#signin{
		width: 60%;
		border-radius: 30px;
		background-color: #fd4720;
	}
	.overlap-text{
		position: relative;
	}
	.overlap-text a{
		position: absolute;
		top: 8px;
		right: 10px;
		font-size: 14px;
		text-decoration: none;
		font-family: 'Overpass Mono', monospace;
		letter-spacing: -1px;

	}
</style>
<body>
<div class="row">
	<div class="col-sm-12">
		<div class="well">
			<center><h1 style="color: white;">talsgrad</h1></center>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h3 style="text-align: center;"><strong>Login to talsgrad</strong></h3>
			</div>
			<div class="l-part">
				<?php 

	include("includes/connection.php");

		if(isset($_GET['name'], $_GET['email'])){
			$first_name = $_GET['name'];
			$email = $_GET['email'];
		}
	 ?>
				<h2><center>Thank you <?php echo "$first_name";?> for signing up! You are one more step away from having a portfolio account!</center></h2><br><br>
				<h3><center>Please check your email for an activation link which will lead you to your account</center></h3><br><br>
				<a href="resend_verification.php?email=<?php echo $email ?>" style="float: left; color: #fd4720;">RESEND ACTIVATION LINK?</a>
				<a href="index.php" style="float: right; color: #fd4720;">GO BACK TO HOMEPAGE!</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>