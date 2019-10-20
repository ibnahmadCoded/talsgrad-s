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

		$user_name = $row['user_name'];
	?>
	<title>Checkout of Bazaar</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>

<div class="row">

	<?php 
		global $con;

			if(isset($_GET['u5Nm'])){

				$u_name = $_GET['u5Nm'];

				$get_u_id = "SELECT user_id FROM users WHERE user_name = '$u_name'";
				$run_get_u_id = mysqli_query($con, $get_u_id);
				$row_u_id = mysqli_fetch_array($run_get_u_id);

				$u_id = $row_u_id['user_id'];

			}

			$get_cart = "SELECT * FROM cart WHERE user_id='$u_id'";
			$run_cart = mysqli_query($con, $get_cart);

			$number  = mysqli_num_rows($run_cart);

			if($number != 0){
				echo "
								<br><br>
			<a href='checkout.php?u5Nm=$u_name&items=$number' style='float: right; margin-right: 100px;'><button class='btn btn-success' style='background-color:#fd4720;'>Checkout</button></a><br>
			 <a href='bazaar.php?u5Nm=$u_name' style='float: left; margin-left: 100px; color: #fd4720;'>Back to Bazaar</a><br>

			";


			}
			else{
				echo "<a href='bazaar.php?u5Nm=$u_name' style='float: left; margin-left: 100px; color: #fd4720;'>Back to Bazaar</button></a><br>";
			}

	 ?>

	<div class="col-sm-12">
		<?php 

			if(isset($_GET['u5Nm'])){
				$u_name = $_GET['u5Nm'];
			}

		 ?>
		<script type="text/javascript">

			var unm = "<?php echo $u_name ?>";
			
			setInterval(function(){
				var $container = $('#container');
				var url = 'my_cart.php?u5Nm='+unm;

				$.ajax(url).done(function(response){
					$container.html(response);
				});
			}, 1000)
		</script>
		<div id="container">

		</div>
	</div>
</div>
</body>
</html>