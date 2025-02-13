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
	<title>Messages</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>
	#scroll_messages{
		max-height: 570px;
		overflow-y: scroll; /* overfloe:scroll; to show scroll bar overflow hidden can only hide the scrollbar but cannot allow scroll */
		overflow-x: hidden;
	}

	/*#scroll_messages::-webkit-scrollbar { /* to hide scroll bar and still be able to scroll 
		display: none;
	}*/

	#btn-msg{
		width: 20%;
		height: 28px;
		border-radius: 5px;
		margin: 5px;
		border: none;
		color: #fff;
		float: right;
		background-color: #2ecc71;
	}
	#select_user{
		max-height: 570px;
		overflow-y: scroll; /* overfloe:scroll; to show scroll bar */
		overflow-x: hidden;
	}
	#green{
		background-color: #fd4720;
		border-color: #27ae60;
		color: white;
		width: 50%;
		padding: 2.5%;
		font-size: 16px;
		border-radius: 3px;
		float: left;
		margin: 0 1.5% 24px 1.5%;
	}

	#blue{
		background-color: #232742;
		border-color: #2980b9;
		color: white;
		width: 50%;
		padding: 2.5%;
		font-size: 16px;
		border-radius: 3px;
		float: right;
		margin: 0 1.5% 24px 1.5%;
	}
</style>
<body>
<div class="row">
	<?php 

		if(isset($_GET['u5Nm'])){
			$u_name = $_GET['u5Nm'];

			$get_user = "SELECT * FROM users WHERE user_name='$u_name'";

			$run_user = mysqli_query($con, $get_user);
			$row_user = mysqli_fetch_array($run_user);

			$user_to_msg = $row_user['user_id'];
			$user_to_name = $u_name;
		}

		$user = $_SESSION['user_email'];
		$get_user = "SELECT * FROM users WHERE email='$user'";
		$run_user = mysqli_query($con, $get_user); 
		$row = mysqli_fetch_array($run_user); 

		$user_from_msg = $row['user_id'];
		$user_from_name = $row['user_name']; 
?>

	<div class='col-sm-3' id='select_user'>
		<?php 
			$user = "SELECT * FROM users";

			$run_user = mysqli_query($con, $user);

			while($row_user = mysqli_fetch_array($run_user)){

				$user_id = $row_user['user_id'];
				$user_name = $row_user['user_name'];
				$first_name = $row_user['f_name'];
				$last_name = $row_user['l_name'];
				$user_image = $row_user['user_image'];

				$get_msg = "SELECT * FROM user_messages WHERE (user_from = '$user_id' AND user_to = '$user_from_msg') OR (user_from = '$user_from_msg' AND user_to = '$user_id')";
				$run_msg = mysqli_query($con, $get_msg); 
				$num_msgs = mysqli_num_rows($run_msg);

				if($num_msgs>0){ //get only users that have sent (or u have sent) messages before!!! Line 1133 ($get_msg) above

					//get number of unread messages!
					$get_umsg = "SELECT * FROM user_messages WHERE user_from = '$user_id' AND user_to = '$user_from_msg' AND msg_seen='no'";
					$run_umsg = mysqli_query($con, $get_umsg); 
					$num_umsgs = mysqli_num_rows($run_umsg);

					if($num_umsgs>0){ //we don't want to show 0!
						$num_umsgs = $num_umsgs;

						$count_msg = $num_umsgs;

						if($count_msg>15){
							//notify if number of unread messages is greater than 15! (not working)
							$notify = "insert into notifications (user_from_id, user_to_id, type, status, date) values('$user_id', '$user_id', 'message', 'unread', NOW())";

							$run_notify = mysqli_query($con, $notify);
						}

					}

					else{
						$num_umsgs = '';
					}

						echo"
							<div class='container-fluid'>
								<a style='text-decoration: none; cursor: pointer; color: #fd4720;' href='update_msg.php?url=messages.php?u5Nm=$user_name&user_to=$user_from_msg&user_from=$user_id'>
								<img class='img-circle' src='users/$user_image' width='90px' height='80px' title='$user_name'> <strong>&nbsp $first_name $last_name</strong> <span class='badge badge-light'>$num_umsgs</span><br><br>
								</a>
							</div>
						";

				}
			}
		  ?>

	</div>
	<div class='col-sm-6'>
		<?php 
			if(isset($_GET['u5Nm'])){
			$u_name = $_GET['u5Nm'];
		}
		 ?>
		
		<script>

				var unm = "<?php echo $u_name ?>";

				var auto_refresh = setInterval(
					(function() {
						$("#loaded_msg").load("message_content.php?u5Nm="+unm); //load the content
					}), 100);
		</script>
		<script>

			var unm = "<?php echo $u_name ?>";

				var auto_refresh = setInterval(
					(function() {
						$("#online").load("check_online.php?u5Nm="+unm); //load the content
					}), 1000);
		</script>
		<div class='load_msg' id='scroll_messages'>

			<div style="color: blue; background-color: #e6e6e6; position: fixed; width: 736px;">
				<?php 
				//show current user at the tom.

					if(isset($_GET['u5Nm'])){

						$u_name = $_GET['u5Nm'];

						if($u_name == 'new'){

							echo"
								<center><h1 style='color:#232742;'>WELCOME TO TALSGRAD'S MESSENGER</h1></center>
							";

						}else{

							$get_u_id = "SELECT * FROM users WHERE user_name = '$u_name'";
							$run_get_u_id = mysqli_query($con, $get_u_id);
							$row_u_id = mysqli_fetch_array($run_get_u_id);

							$run_user = mysqli_query($con, $get_user);
							$row = mysqli_fetch_array($run_user);

							$user_id = $row_u_id['user_id'];
							$f_name = $row_u_id['f_name'];
							$l_name = $row_u_id['l_name'];
							$u_image = $row_u_id['user_image'];

							echo"
								<div class='container-fluid' style='padding-top:10px;'>
									<a style='text-decoration: none; cursor: pointer; color: #fd4720;' href='user_profile.php?u5Nm=$u_name'>
									<img class='img-circle' src='users/$u_image' width='90px' height='80px' title='$user_name'> <strong>&nbsp $f_name $l_name</strong>&nbsp&nbsp<span id='online'></span><br><br>
									</a>
								</div>
							";
						}
					}

				 ?>	
			</div>
			<div style="height: 110px;">
				
			</div>

			<div id='loaded_msg'>
					
			</div>

		</div>
		<?php
			if(isset($_GET['u5Nm'])){
				$u_name = $_GET['u5Nm'];
				if($u_name == "new"){
					echo"

						<form>
							<center><h3>Please select Someone to start or continue your conversation.</h3></center>
							<textarea disabled class='form-control' placeholder='Type your Message'></textarea>
							<input type='submit' class='btn btn-default' disabled value='Send'>
						</form><br><br>

					";
				}
				else{
				echo"
					<form action='' method='POST'>
						<textarea class='form-control' placeholder='Type your Message' name='msg_box' id='msg_textarea'></textarea>
						<input type='submit' style='background-color:#232746;' name='send_msg' id='btn-msg' value='Send'>
					</form><br><br>
					";
				}
			}
		?>

		<?php 
			if(isset($_POST['send_msg'])){
				$msg = htmlentities($_POST['msg_box']);

				if($msg == ""){
					echo"<h4 style='color: red; text-align: center;'>Unable to send an empty message!</h4>";
				}else if(strlen($msg)>101){
					echo"<h4 style='color: red; text-align: center;'>Message is greater than 101 characters!</h4>";
				}else{
					$insert = "insert into user_messages(user_to, user_from, msg_body, date, msg_seen) values ('$user_to_msg', '$user_from_msg', '$msg', NOW(), 'no')";

					$run_insert = mysqli_query($con, $insert);

					echo "<meta http-equiv='refresh' content='0'>";
				}
			}
		?>
		
	</div>
	<div class='col-sm-3'>
		<?php 
			if(isset($_GET['u5Nm'])){

				$u_name = $_GET['u5Nm'];

				$get_u_id = "SELECT user_id FROM users WHERE user_name = '$u_name'";
				$run_get_u_id = mysqli_query($con, $get_u_id);
				$row_u_id = mysqli_fetch_array($run_get_u_id);

				$get_id = $row_u_id['user_id'];

				$get_user = "SELECT * FROM users WHERE user_id='$get_id'";
				$run_user = mysqli_query($con, $get_user);
				$row = mysqli_fetch_array($run_user);

				$user_id = $row['user_id'];
				$user_name = $row['user_name'];
				$f_name = $row['f_name'];
				$l_name = $row['l_name'];
				$describe_user = $row['describe_user'];
				$user_country = $row['user_country'];
				$user_image = $row['user_image'];
				$register_date = $row['user_reg_date'];
				$gender = $row['user_gender'];
			}

			if($get_id == "new"){

			}else{
				echo"
					<div class='row'>
						<div class='col-sm-2'>
						</div>
						<center>
						<div style='background-color: #e6e6e6' class='col-sm-9'>
							<h2>You're conversing with</h2>
							<img class='img-circle' src='users/$user_image' width='150' height='150'>
							<br><br>
							<ul class='list-group'>
								<li class='list-group-item' title='Username'><strong>$f_name $l_name</strong></li>

								<li class='list-group-item' title='User Status'><strong style='color: grey;'>$describe_user</strong></li>

								<li class='list-group-item' title='Gender'>$gender</li>

								<li class='list-group-item' title='Username'>$user_country</li>

								<li class='list-group-item' title='Username'>$register_date</li>
							</ul>
						</div>
						<div class='col-sm-1'>
						</div>
					</div>
				";
			}
		?>
	</div>
</div>
<script>
	var div = document.getElementById("scroll_messages");
	div.scrollTop = div.scrollHeight;
</script>
</body>
</html>