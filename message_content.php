<?php 
		
include("includes/connection.php");
session_start();

if(!isset($_SESSION['user_email'])){

	session_destroy();
			    
	header("location: index.php");
}
	
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
		<?php
				$sel_msg = "SELECT * FROM user_messages WHERE (user_to='$user_to_msg' AND user_from='$user_from_msg') OR (user_from='$user_to_msg' AND user_to='$user_from_msg') ORDER by 1 ASC";
				$run_msg = mysqli_query($con, $sel_msg);

				while($row_msg = mysqli_fetch_array($run_msg)){

					$user_to = $row_msg['user_to'];
					$user_from = $row_msg['user_from'];
					$msg_body = $row_msg['msg_body'];
					$msg_date = $row_msg['date'];
					?>

						<p><?php 

							if($user_to == $user_to_msg AND $user_from == $user_from_msg){

								echo"<div class='message' id='blue' data-toggle='tooltip' title='$msg_date'>$msg_date <br> $msg_body</div><br><br><br>";

							} else if($user_from == $user_to_msg AND $user_to == $user_from_msg){

								echo"<div class='message' id='green'data-toggle='tooltip' title='$msg_date'>$msg_date <br> $msg_body</div><br><br><br>";

							}

							?></p>

					<?php
				}
 ?>