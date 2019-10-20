<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
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
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		#$user_name = $row['user_name'];
		$user_fname = $row['f_name'];
		$user_lname = $row['l_name'];
	?>
	<title>Talsgrad's Bazaar: <?php echo "$user_fname $user_lname"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>
	#cover-img{
		height: 400px;
		width: 100%;
	}
	#bazaar_posts{
	background: #fff;
		box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		border-radius: 30px 30px 30px 30px;

	width: 500px;
	height: 350px;
	margin-bottom: 20px;
	margin-right: 20px;
	padding: 40px 50px;
	position: sticky;
	left:20px;

}

	#baz_posts{
	background: #fff;
		box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		border-radius: 30px 30px 30px 30px;

	width: 500px;
	height: 200px;
	margin-bottom: 20px;
	margin-right: 20px;
	padding: 40px 50px;
	position: sticky;
	left:2000px;

}



* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
<body>
<div class="row">

	<div class="col-sm-12">

			<div class="mySlides fade">

			  <?php
			echo"
			<div>
				<div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover' style='padding:10px; width=100%;'></div>
				
			</div><br>
			";
		?>


			</div>

			<div class="mySlides fade">
			  <?php
			echo"
			<div>
				<div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover' style='padding:10px; width=100%;'></div>
				
			</div><br>
			";
			?>
			</div>

			<div class="mySlides fade">
			  <?php
			echo"
			<div>
				<div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover' style='padding:10px; width=100%;'></div>
				
			</div><br>
			";
		?>
			</div>

			<div style="text-align:center">
			  <span class="dot"></span> 
			  <span class="dot"></span> 
			  <span class="dot"></span> 
			</div>

	<script>
		var slideIndex = 0;
		showSlides();

		function showSlides() {
		  var i;
		  var slides = document.getElementsByClassName("mySlides");
		  var dots = document.getElementsByClassName("dot");
		  for (i = 0; i < slides.length; i++) {
		    slides[i].style.display = "none";  
		  }
		  slideIndex++;
		  if (slideIndex > slides.length) {slideIndex = 1}    
		  for (i = 0; i < dots.length; i++) {
		    dots[i].className = dots[i].className.replace(" active", "");
		  }
		  slides[slideIndex-1].style.display = "block";  
		  dots[slideIndex-1].className += " active";
		  setTimeout(showSlides, 3000); // Change image every 3 seconds
		}
	</script>
</div>

</div>
<div class="row">
	<div class="col-sm-12">
		<?php 
			if(isset($_GET['u5Nm'])){
				$u_name = $_GET['u5Nm'];

				$get_u_id = "SELECT user_id FROM users WHERE user_name = '$u_name'";
				$run_get_u_id = mysqli_query($con, $get_u_id);
				$row_u_id = mysqli_fetch_array($run_get_u_id);

				$u_id = $row_u_id['user_id'];
			}
		?>
		<script type="text/javascript">

			var unm = "<?php echo $u_name ?>";
			
			setInterval(function(){
				var $container = $('#container');
				var url = 'cart_content.php?u5Nm='+unm;

				$.ajax(url).done(function(response){
					$container.html(response);
				});
			}, 1000)
		</script>
		<div id="container">
		
		</div>
		<div class="col-sm-3">
			<!-- display user posts -->
			<?php 
			global $con;

				$get_posts = "SELECT * FROM posts WHERE bazaar='yes' ORDER by 1 DESC";

				$run_posts = mysqli_query($con, $get_posts);

				while ($row_posts = mysqli_fetch_array($run_posts)) {

					$post_id = $row_posts['post_id'];
					$user_id = $row_posts['user_id'];
					$content = $row_posts['post_content'];
					$upload_image = $row_posts['upload_image'];
					$post_date = $row_posts['post_date'];

					$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes'";

					$run_user = mysqli_query($con, $user);
					$row_user = mysqli_fetch_array($run_user);

					$user_nom = $row_user['user_name'];
					$user_fname = $row_user['f_name'];
					$user_lname = $row_user['l_name'];
					$user_image = $row_user['user_image'];

					$bazaar = "SELECT * FROM bazaar WHERE user_id='$user_id' AND post_id='$post_id'";

					$run_bazaar = mysqli_query($con, $bazaar);
					$row_bazaar = mysqli_fetch_array($run_bazaar);

					$price = $row_bazaar['price'];

					if($u_id == $user_id){

						if($content == "No" && strlen($upload_image)>=1){
							echo "

							<div id='bazaar_posts'>
								<div class='row'>
									<div class='col-sm-2'>
										<p><img src='users/$user_image' class='img-circle' width='50px' height='50px'></p>
									</div>
									<div class='col-sm-6'>
										<a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_nom'>$user_fname $user_lname</a><br>
										<small style='color:black;'>Price: <strong>$price</strong></small>
									</div>
									<div class='col-sm-4'>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-12'>
										<img id='posts-img' src='imagepost/$upload_image' style='height:100px; width:100px;'>
									</div>
								</div><br>

							</div>

							";

						}

						else if(strlen($content) >= 1 && strlen($upload_image)>=1){
							echo "

							<div id='bazaar_posts'>
								<div class='row'>
									<div class='col-sm-2'>
										<p><img src='users/$user_image' class='img-circle' width='50px' height='50px'></p>
									</div>
									<div class='col-sm-6'>
										<a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_nom'>$user_fname $user_lname</a><br>
										<small style='color:black;'>Price: <strong>$price</strong></small>
									</div>
									<div class='col-sm-4'>
									</div>	
								</div>
								<div class='row'>
									<div class='col-sm-12'>
										<p>$content</p>
									<img id='posts-img' src='imagepost/$upload_image' style='height:100px; width:100px;'>
									</div>
								</div><br>


							</div>

							";
						}

					}
					else { //not from the user

						if($content == "No" && strlen($upload_image)>=1){
							echo "

							<div id='bazaar_posts'>
								<div class='row'>
									<div class='col-sm-2'>
										<p><img src='users/$user_image' class='img-circle' width='50px' height='50px'></p>
									</div>
									<div class='col-sm-6'>
										<a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_nom'>$user_fname $user_lname</a><br>
										<small style='color:black;'>Price: <strong>$price</strong></small>
									</div>
									<div class='col-sm-4'>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-12'>
										<img id='posts-img' src='imagepost/$upload_image' style='height:100px; width:100px;'>
									</div>
								</div><br>
								<a href='add_to_cart.php?post_id=$post_id' name='add_to_cart' style='float: left; color: #fd4720; margin: 0 1.5% 24px 1.5%;'>Add To Cart</a><br>
								<a href='inquire.php?post_id=$post_id' style='float: right; margin: 0 1.5% 24px 1.5%;'><button class='btn btn-info' style='background-color:#fd4720;'>Inquire</button></a><br>
							</div>

							";

						}

						else if(strlen($content) >= 1 && strlen($upload_image)>=1){
							echo "

							<div id='bazaar_posts'>
								<div class='row'>
									<div class='col-sm-2'>
										<p><img src='users/$user_image' class='img-circle' width='50px' height='50px'></p>
									</div>
									<div class='col-sm-6'>
										<a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_nom'>$user_fname $user_lname</a><br>
										<small style='color:black;'>Price: <strong>$price</strong></small>
									</div>
									<div class='col-sm-4'>
									</div>	
								</div>
								<div class='row'>
									<div class='col-sm-12'>
										<p>$content</p>
									<img id='posts-img' src='imagepost/$upload_image' style='height:100px; width:100px;'>
									</div>
								</div><br>
								<a href='add_to_cart.php?post_id=$post_id' name='add_to_cart' style='float: left; color: #fd4720; margin: 0 1.5% 24px 1.5%;'>Add To Cart</a><br>
								<a href='inquire.php?post_id=$post_id' style='float: right; margin: 0 1.5% 24px 1.5%;'><button class='btn btn-info' style='background-color:#fd4720;'>Inquire</button></a><br>
							</div>

							";

				
						}

					}

				}

			 ?>
		</div>
		<div class="col-sm-2">
			
		</div>
		<div class="col-sm-3">
			<!-- display users' posts where there is no post image (in this div only-->
			<?php 
			global $con;

				$get_posts = "SELECT * FROM posts WHERE bazaar='yes' ORDER by 1 DESC";

				$run_posts = mysqli_query($con, $get_posts);

				while ($row_posts = mysqli_fetch_array($run_posts)) {

					$post_id = $row_posts['post_id'];
					$user_id = $row_posts['user_id'];
					$content = $row_posts['post_content'];
					$upload_image = $row_posts['upload_image'];
					$post_date = $row_posts['post_date'];

					$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes'";

					$run_user = mysqli_query($con, $user);
					$row_user = mysqli_fetch_array($run_user);

					$user_nom = $row_user['user_name'];
					$user_fname = $row_user['f_name'];
					$user_lname = $row_user['l_name'];
					$user_image = $row_user['user_image'];

					$bazaar = "SELECT * FROM bazaar WHERE user_id='$user_id' AND post_id='$post_id'";

					$run_bazaar = mysqli_query($con, $bazaar);
					$row_bazaar = mysqli_fetch_array($run_bazaar);

					$price = $row_bazaar['price'];

					if($u_id == $user_id){

						if($content == "No" && strlen($upload_image)>=1){
							

						}

						else if(strlen($content) >= 1 && strlen($upload_image)>=1){
							
						}

						else {
							echo "

							<div id='baz_posts'>
								<div class='row'>
									<div class='col-sm-2'>
										<p><img src='users/$user_image' class='img-circle' width='50px' height='50px'></p>
									</div>
									<div class='col-sm-6'>
										<a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_nom'>$user_fname $user_lname</a><br>
										<small style='color:black;'>Price: <strong>$price</strong></small>
									</div>
									<div class='col-sm-4'>
									</div>	
								</div>
								<div class='row'>
									<div class='col-sm-2'>
									</div>
									<div class='col-sm-6'>
										<p>$content</p>
									</div>
									<div class='col-sm-4'>

									</div>

							</div>

							";

							
								echo "
								</div>
								";

						}

					}
					else { //not from the user

						if($content == "No" && strlen($upload_image)>=1){
							

						}

						else if(strlen($content) >= 1 && strlen($upload_image)>=1){
							
						}

						else {
							echo "

							<div id='baz_posts'>
								<div class='row'>
									<div class='col-sm-2'>
										<p><img src='users/$user_image' class='img-circle' width='50px' height='50px'></p>
									</div>
									<div class='col-sm-6'>
										<a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_nom'>$user_fname $user_lname</a><br>
										<small style='color:black;'>Price: <strong>$price</strong></small>
									</div>
									<div class='col-sm-4'>
									</div>	
								</div>
								<div class='row'>
									<div class='col-sm-2'>
									</div>
									<div class='col-sm-6'>
										<p>$content</p>
									</div>
									<div class='col-sm-4'>

									<a href='inquire.php?post_id=$post_id' style='float: right; margin: 0 1.5% 24px 1.5%;'><button class='btn btn-info' style='background-color:#fd4720;'>Inquire</button></a><br>
									</div>
									<a href='add_to_cart.php?post_id=$post_id' name='add_to_cart' style='float: left; color: #fd4720; margin: 0 1.5% 24px 1.5%;'>Add To Cart</a><br>

							</div>

							";

							
								echo "
								</div>
								";

						}

					}

				}

			 ?>
		</div>
	</div>
</div>
</body>
</html>