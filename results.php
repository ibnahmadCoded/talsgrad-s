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
	<title>Search Results</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
	<?php 

		if(isset($_GET['search'])){
			$search_query = htmlentities($_GET['user_query']);
		}

	 ?>
	<script type="text/javascript">

			var unm = "<?php echo $search_query ?>";
			var a = " ";
			
			setInterval(function(){
				var $container = $('#container');
				var url = 'my_results.php?user_query='+unm+'&search='+a;

				$.ajax(url).done(function(response){
					$container.html(response);
				});
			}, 1000)
		</script>
<div id="container">

</div>
</body>
</html>