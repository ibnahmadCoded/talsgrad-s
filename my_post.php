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
	<title>My Portfolio Items</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
	<div class='row'>
		<?php 
			$getunm = "SELECT user_name FROM users WHERE email = '$email'";
			$rununm = mysqli_query($con, $getunm);
			$row = mysqli_fetch_array($rununm);

			$u_name = $row['user_name'];
		 ?>
		<script type="text/javascript">

			var unm = "<?php echo $u_name ?>";
			
			setInterval(function(){
				var $container = $('#container');
				var url = 'my_myposts.php?u5Nm='+unm;

				$.ajax(url).done(function(response){
					$container.html(response);
				});
			}, 1000)
		</script>
		<div id="container">
		
		</div>
</div>
</body>

</html>