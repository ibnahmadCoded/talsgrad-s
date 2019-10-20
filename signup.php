<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
	#signup{
		width: 60%;
		border-radius: 30px;
		background-color: #fd4720;
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
					<h3 style="text-align: center;"><strong>Create Your Portfolio Account</strong></h3><hr>
				</div>
				<div class="l-part">
					<form method="post" action="">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
							<input type="text" class="form-control" placeholder="First Name" name="first_name" required="required">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
							<input type="text" class="form-control" placeholder="Last Name" name="last_name" required="required">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="password" type="password" class="form-control" placeholder="Password" name="u_pass" required="required">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="email" type="email" class="form-control" placeholder="Email" name="u_email" required="required">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
							<select class="form-control" name="u_country" required="required">
								<option disabled>Select your Country</option>
								<option>Pakistan</option>
								<option>United States of America</option>
								<option>India</option>
								<option>Japan</option>
								<option>UK</option>
								<option>France</option>
								<option>Germany</option>
								<option>Nigeria</option>
							</select>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
							<select class="form-control input-md" name="u_gender" required="required">
								<option disabled>Select your Gender</option>
								<option>Male</option>
								<option>Female</option>
							</select>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="date" class="form-control input-md" placeholder="Birth Date" name="u_birthday" required="required">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
							<input id="best_friend" type="text" class="form-control" placeholder="Your best friend's name" name="best_friend" required="required">
						</div><br>
						<a style="text-decoration: none;float: right;color: #fd4720;" data-toggle="tooltip" title="Signin" href="signin.php">Already have an account?</a><br><br>

						<center><button id="signup" class="btn btn-info btn-lg" name="sign_up">Signup</button></center>
						<?php include("insert_user.php");?>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>