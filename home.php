<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");
include("includes/connection.php");

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
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_fname = $row['f_name'];
		$user_lname = $row['l_name'];
	?>
	<title>Talsgrad's Home: <?php echo "$user_fname $user_lname"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	<script type="text/javascript">
		window.onload = function(){
			document.getElementById('ifYes').style.display = 'none' ;
		}
		function yesnoCheck() {
			if (document.getElementById('yesCheck').checked) { 
	    		document.getElementById('ifYes').style.display = 'block' ;
			}
			else {
				document.getElementById('ifYes').style.display = 'none' ;
			}
		}
		
	</script>
</head>

<body>

<div class="row">
	<div id="insert_post" class="col-sm-12">
		<center>
		<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
		<textarea class="form-control" id="content" rows="4" name="content" placeholder="What's in your mind?"></textarea><br>
		<label class="btn btn-warning" id="upload_image_button" style="background-color: #232742;">Select Image
		<input type="file" name="upload_image" size="30">
		</label>
		<button id="btn-post" class="btn btn-success" name="sub" style="background-color: #fd4720;">Add Item</button>
		List on Bazaar? <input type="checkbox" name="checkbox1" onclick = "javascript:yesnoCheck();" value="list_on_bazaar" id="yesCheck" style=" padding: 0px; margin:0px;">
		<div id="ifYes" style="display:none; float: right; padding: 0px; margin-left: 0px; margin-right:215px;"> Please Input Price:
			Item Price: <input type="text" id = "itemprice" name="price" placeholder="example: 500 Naira">
		</div>
		</form>
		<?php insertPost(); ?>
		</center>
	</div>
</div>
<div id="container">

</div>
</body>
<script type="text/javascript">
	setInterval(function(){
		var $container = $('#container');
		var url = 'my_home.php';

		$.ajax(url).done(function(response){
			$container.html(response);
		});
	}, 1000)
</script>
</html>