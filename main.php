<!DOCTYPE html>
<html>
<head>
	<title>Talsgrad login and signup</title>
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
	#centered1{
		position: absolute;
		font-size: 10vw;
		top: 30%;
		left: 30%;
		transform: translate(-50%, -50%);
	}
	#centered2{
		position: absolute;
		font-size: 10vw;
		top: 50%;
		left: 40%;
		transform: translate(-50%, -50%);
	}
	#centered3{
		position: absolute;
		font-size: 10vw;
		top: 70%;
		left: 30%;
		transform: translate(-50%, -50%);
	}
	#signup{
		width: 60%;
		border-radius: 30px;
		background-color: #fd4720;
	}
	#login{
		width: 60%;
		background-color: #fff;
		border: 1px solid #fd4720;
		color: #fd4720;
		border-radius: 30px;
	}
	#login:hover{
		width: 60%;
		background-color: #fff;
		color: #fd4720;
		border: 2px solid #fd4720;
		border-radius: 30px;
	}
	.well{
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
		<div class="col-sm-6" style="left: 0.5%">
			<img src="images/index_img3.jpeg" class="img-rounded" title="talsgrad" width="650px" height="565px">
			<div id="centered1" class="centered"><h3 style="color: white;"><span class="glyphicon glyphicon-search">&nbsp<strong></strong>Unleash The Talent Within!</span></h3></div>
			<div id="centered2" class="centered"><h3 style="color: white;"><span class="glyphicon glyphicon-search">&nbsp<strong></strong>Let Your Portfolio Speak for You</span></h3></div>
			<div id="centered3" class="centered"><h3 style="color: white;"><span class="glyphicon glyphicon-search">&nbsp<strong></strong>Connect and Find Top Talents</span></h3></div>
		</div>
		<div id='myModal' class='modal fade' role='dialog'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal'>&times;</button>
										<h4 class='modal-title'>Why Talsgrad?</h4>
									</div>
									<div class='modal-body'>

										<center><h3 style="margin-top: 0px;"><strong>Who is Talsgrad for?</strong></h3></center><br>
										<p class="glyphicon glyphicon-star"> The talented/gifted persons who want to share thier talents/gifts with the world.</p>
										<p class="glyphicon glyphicon-star"> The students who want to thier portfolio for future use in the job market.</p>
										<p class="glyphicon glyphicon-star"> The professionals who are building thier portfolio.</p>
										<p class="glyphicon glyphicon-star"> The talent scouts who want to find new talents.</p>
										<p class="glyphicon glyphicon-star"> The future greats who want to connect with great minds like them</p>
										<p class="glyphicon glyphicon-star"> The project managers seeking the best hands for thier projects.</p>
										<p class="glyphicon glyphicon-star"> The sportsmen and sportswomen who want to show thier capabilitites to the world.</p>
										<p class="glyphicon glyphicon-star"> The job seekers who want thier recommendations to reach the right people.</p>
										<p class="glyphicon glyphicon-star"> Every person who is looking for inspiration.</p><br>

										<center><h3 style="margin-top: 50px;"><strong>What can you do on Talsgrad?</strong></h3></center><br>
										<p class="glyphicon glyphicon-star"> Upload images of your works as your portfolio items.</p>
										<p class="glyphicon glyphicon-star"> Recommend other users to people.</p>
										<p class="glyphicon glyphicon-star"> Get recommended to people. If the need arises, you can also recommend yourself.</p>
										<p class="glyphicon glyphicon-star"> If the need arises, you can also recommend yourself.</p><br>
										<p class="glyphicon glyphicon-star"> Scout registered users.</p>
										<p class="glyphicon glyphicon-star"> If your portfolio item is something you can sell, you can list it on bazaar to find buyers who will appreciate you and your product.</p>
										<p class="glyphicon glyphicon-star"> And many other fucntionilties you will see once you use our platform.</p>

										<center><h3 style="margin-top: 50px;"><strong>How can you benefit from Talsgrad?</strong></h3></center><br>
										The simple rule to reap loads of benefit from Talsgrad is: 'post the right things, i.e your works/products, you working/doing what you do best, etc. In a nutshell, try to build your portfolio on the platform, so that people can recommend you and your work(s) can server as proof for you. And this is because, in a world where every other person has educational and professional certificates, what matters is what your mind and hands have done -- a  pointer to the marvels you can bring into existence by Grace.<br><br>

										<center><p style="color: #fd4720;"> SIGN-UP TO FIND OUT MORE...THANK YOU!</p></center>

									</div>
									<div class='modal-footer'>
										<button type='button' class='btn btn-default' data-dismiss='modal' style="background-color: #232746; color: white;">Close</button>
									</div>
								</div>
							</div>
						</div>
		<div class="col-sm-6" style="left: 8%">
			<img src="images/Capture2.png" class="img-rounded" title="talsgrad" width="`200px" height="80px"><a href="#"><button type='button' class='btn btn-default' data-toggle='modal' data-target='#myModal' style="background-color: #232746; color: white;">Find Out Why!</button></a>
			<h2 style="margin-left: 70px;"><strong style="margin-left: 30px;">See the works of <br> the world's top talents</strong></h2><br><br>
			<h4 style="margin-left: 8px;"><strong>Join talsgrad to create your free portfolio account!</strong></h4>
			<form method="post" action="">
				<button id="signup" class="btn btn-info btn-lg" name="signup"> Sign up</button><br><br>
				<?php
					if(isset($_POST['signup'])){
						echo "<script>window.open('signup.php','_self')</script>";
					} 
				?>
				<button id="login" class="btn btn-info btn-lg" name="login"> Login</button><br><br>
				<?php
					if(isset($_POST['login'])){
						echo "<script>window.open('signin.php','_self')</script>";
					} 
				?>
			</form>
		</div>
	</div>
</body>
</html>