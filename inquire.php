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
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_fname = $row['f_name'];
		$user_lname = $row['l_name'];
		$user_nom = $row['user_name'];
	?>
	<title>Inquire: <?php echo "$user_fname $user_lname"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">

<body>
<?php 

if (isset($_GET['post_id'])) {
		global $con;

		$get_id = $_GET['post_id'];

		$get_posts = "SELECT * FROM posts WHERE post_id='$get_id'";

		$run_posts = mysqli_query($con, $get_posts);

		$row_posts = mysqli_fetch_array($run_posts);

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];
		$bazaar = $row_posts['bazaar'];

		$bazaar = "SELECT * FROM bazaar WHERE user_id='$user_id' AND post_id='$post_id'";

		$run_bazaar = mysqli_query($con, $bazaar);
		$row_bazaar = mysqli_fetch_array($run_bazaar);

		$price = $row_bazaar['price'];

		$get_user = "SELECT * FROM users WHERE user_id = '$user_id'";
		$run_user = mysqli_query($con, $get_user);
		$row_user = mysqli_fetch_array($run_user);

		$user_fname = $row_user['f_name'];
		$user_lname = $row_user['l_name'];
		$user_name = $row_user['user_name'];
		$user_img = $row_user['user_image'];

		$output1 = date("d - M - Y", strtotime($post_date));
		$output2 = date("H:i", strtotime($post_date));

					if($content=="No" && strlen($upload_image) >= 1){
					echo"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
								<p><img src='users/$user_img' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Added an item on <strong>$output1</strong> at <strong>$output2</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
									<h4><small style='color:black;'>Price: <strong>$price</strong></small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";
				}

				else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
					echo"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
								<p><img src='users/$user_img' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Added an item on <strong>$output1</strong> at <strong>$output2</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
									<h4><small style='color:black;'>Price: <strong>$price</strong></small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<p>$content</p>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";
				}

					else{
					echo"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
								<p><img src='users/$user_img' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Added an item on <strong>$output1</strong> at <strong>$output2</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
									<h4><small style='color:black;'>Price: <strong>$price</strong></small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";
				} //end of else
				

					echo "
					<div class='row'>
						<div class='col-md-6 col-md-offset-3'>
							<div class='panel panel-info'>
								<div class='panel-body'>
									<form action='' method='post' class='form-inline'>
									<textarea placeholder='Write your inquiry here!' class='pb-cmnt-textarea' name='inquire'></textarea>
									<button class='btn btn-info pull-right' name='reply' style='background-color: #fd4720;'>Send Inqury</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					";

					if(isset($_POST['reply'])){

								global $con;

								$url = $_SERVER['REQUEST_URI'];

								$receiver_id = $user_id;

								$user = $_SESSION['user_email'];
								$get_user = "SELECT * FROM users WHERE email='$user'";
								$run_user = mysqli_query($con,$get_user);
								$row = mysqli_fetch_array($run_user);
								$sender_id = $row['user_id'];




								$inquire = htmlentities($_POST['inquire']);

								$msg = $inquire. '
								The Product is: ' .$url;

								if($inquire == ""){
									echo "<script>alert('Please write your inquiry!')</script>";
									echo "<script>window.open('inquire.php?post_id=$post_id', '_self')</script>";
								}else{

									$insert = "insert into user_messages(user_to, user_from, msg_body, date, msg_seen) values ('$receiver_id', '$sender_id', '$msg', NOW(), 'no')";

									$run_insert = mysqli_query($con, $insert);

									if($run_insert){

										//notify the product owner
										$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$sender_id', '$receiver_id', '$post_id', 'inquire', 'unread', NOW())";

										$run_notify = mysqli_query($con, $notify);

										//notify the inuirer 
										$notify1 = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$sender_id', '$sender_id', '$post_id', 'inquire', 'unread', NOW())";
										$run_notify1 = mysqli_query($con, $notify1);

										if($run_notify && $run_notify1){

										echo "<script>window.open('inquire.php?post_id=$post_id', '_self')</script>";}

									}
								}
							}


	}

 ?>

</body>
</html>

