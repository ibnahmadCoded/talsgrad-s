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
	<title>Edit Post</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class='row'>
	<div class="col-sm-3">
	</div>
	<div class="col-sm-6">
		<?php 
		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];

			$get_post = $_GET['post_id'];
			$get_post = "SELECT * FROM posts WHERE post_id='$post_id'";
			$run_post = mysqli_query($con, $get_post);
			$row = mysqli_fetch_array($run_post);

			$post_con = $row['post_content'];
			$user_id = $row['user_id'];
			$bazaar = $row['bazaar'];

			$get_bazaar = "SELECT * FROM bazaar WHERE post_id='$post_id' AND user_id= '$user_id'";
			$run_bazaar = mysqli_query($con, $get_bazaar);
			$row_bazaar = mysqli_fetch_array($run_bazaar);

			$bazaar_id = $row_bazaar['baz_id'];
			$price = $row_bazaar['price'];
		}

		 ?>

		 <form action="" method="post" id="f">
		 	<center><h2>Edit Your Post:</h2></center>
		 	<textarea class="form-control" cols="83" rows="4" name="content"><?php echo $post_con;?></textarea><br>
		 	<?php 

		 		if($bazaar == 'yes'){
		 			echo "Item Price: <input type='text' id = 'itemprice' name='price' placeholder='$price'><br><br>";
		 		}

		 	 ?>
		 	<input type="submit" style="float: right; background-color: #fd4720;" name="update" value="Update Post" class="btn btn-info">
		 </form>

		 <?php 

		 if(isset($_POST['update'])){
		 	$content = $_POST['content'];
		 	$bazaar_price = $_POST['price'];


		 	$update_post = "UPDATE posts set post_content='$content' WHERE post_id='$post_id'";
			$run_update = mysqli_query($con, $update_post);

			$update_bazaar = "UPDATE bazaar SET price='$bazaar_price' WHERE baz_id='$bazaar_id'";
			$run_bazaar_update = mysqli_query($con, $update_bazaar);

			 	if($run_update || $run_bazaar_update){

			 		#echo "<script>alert('Your post has been updated!')</script>";
			 		echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
			 	}
		 	}


		  ?>
	</div>
	<div class="col-sm-3">
		
	</div>
</div>
</body>
</html>