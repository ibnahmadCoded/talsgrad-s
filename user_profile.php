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
	<title>Find Talents</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<script>
		
		window.onload = function(){
			document.getElementById('ifYes').style.display = 'none' ;
		}
		function emailCheck() {
			if (document.getElementById('yesCheck').checked) { 
	    		document.getElementById('ifYes').style.display = 'block' ;
			}
			else {
				document.getElementById('ifYes').style.display = 'none' ;
			}
		}

		window.onload = function(){
			document.getElementById('ifNo').style.display = 'none' ;
		}
		function talsmsgCheck() {
			if (document.getElementById('noCheck').checked) { 
	    		document.getElementById('ifNo').style.display = 'block' ;
			}
			else {
				document.getElementById('ifNo').style.display = 'none' ;
			}
		}
</script>
<style>
#own_posts{
	background: #fff;
		box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		border-radius: 30px 30px 30px 30px;
		padding: 40px 50px;
	width: 90%;
}
#post_img{
	height: 300px;
	width: 100%;
}

* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color:  #e6e6e6;;
  color: black;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 2px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 0px 0 2px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  height: 50px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
  width: 49%;
  margin-top: 0px;
  margin-bottom:0px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
#scroll_messages{
		max-height: 300px;
		overflow-y: scroll; /* overfloe:scroll; to show scroll bar */
		overflow-x: hidden;
	}

#scroll_messages::-webkit-scrollbar {
		display: none;
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
	margin-bottom: 5px;
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
	margin-bottom: 5px;
}
#userslist{   
   cursor:pointer;
   background-color:#eee; 
   width:450px;  
} 
#listedresult{
 	padding:12px;
}   
</style>  
<body>
<div class="row">
	<?php

		if(isset($_GET['u5Nm'])){
			$u_name = $_GET['u5Nm'];

			$get_u_id = "SELECT user_id FROM users WHERE user_name = '$u_name'";
			$run_get_u_id = mysqli_query($con, $get_u_id);
			$row_u_id = mysqli_fetch_array($run_get_u_id);

			$u_id = $row_u_id['user_id'];

		}
		if($u_id < 0 || $u_id == ""){
			echo"<script>window.open('home.php', '_self')</script>";
		}else{
	?>

	<div class="col-sm-12">

		<?php
			if(isset($_GET['u5Nm'])){
				global $con;

				$user_name = $_GET['u5Nm'];

				$select = "SELECT * FROM users WHERE user_name='$user_name'";
				$run = mysqli_query($con, $select);
				$row = mysqli_fetch_array($run);

				$user_id = $row['user_id'];
				$image = $row['user_image'];
				$user_name = $row['user_name'];
				$f_name = $row['f_name'];
				$l_name = $row['l_name'];
				$describe_user = $row['describe_user'];
				$country = $row['user_country'];
				$gender = $row['user_gender'];
				$register_date = $row['user_reg_date'];

				echo"
					<div class='row'>
						<div class='col-sm-1'>
						</div>
						<center>
						<div style='background-color: #e6e6e6;' class='col-sm-3'>
						<h2>Information about</h2>
						<img class='img-circle' src='users/$image' width='150' height='150'>
						<br><br>
						<ul class='list-group'>
							<li class='list-group-item' title='Username'><strong>$f_name $l_name</strong></li>
							<li class='list-group-item' title='User Status'><strong style='color: grey;'>$describe_user</strong></li>

							<li class='list-group-item' title='Gender'><strong>$gender</strong></li>

							<li class='list-group-item' title='Username'><strong>$country</strong></li>

							<li class='list-group-item' title='Username'><strong>$register_date</strong></li>
						</ul>
				";

				$user = $_SESSION['user_email'];
				$get_user = "SELECT * FROM users WHERE email='$user'";
				$run_user = mysqli_query($con, $get_user);
				$row = mysqli_fetch_array($run_user);

				$userown_id = $row['user_id'];
				$user_nom = $row['user_name'];
				#$type = 'unfollow';

				if($user_id == $userown_id){
					echo"<a href='edit_profile.php' class='btn btn-success' style='background-color: #232742;'/>Edit Profile</a><br><br> ";
					echo"<a href='#' data-toggle='modal' data-target='#myModal' name='recommend' class='btn btn-info' style='background-color: #fd4720;'>Recommend yourself</a><br><br><br> ";
				}else{

					$get_follow = "SELECT * FROM follow WHERE followed_id='$user_id' AND follower_id = '$userown_id' ";

					$run_get_follow = mysqli_query($con, $get_follow);

					if(mysqli_num_rows($run_get_follow)==0){
						echo"<a href='follow_user.php?u5Nm=$user_name' class='btn btn-success' style='background-color: #232742;'/>Scout</a><br><br> ";
						echo"<a href='#' data-toggle='modal' data-target='#myModal' name='recommend' class='btn btn-info' style='background-color: #fd4720;'>Recommend This User</a><br><br><br> ";
					}
					else{
						echo"<a href='unfollow_user.php?u5Nm=$user_name' class='btn btn-success' style='background-color: #232742;'/>Unscout</a><br><br> ";
						echo"<a href='#' data-toggle='modal' data-target='#myModal' name='recommend' class='btn btn-info' style='background-color: #fd4720;'>Recommend This User</a><br><br><br> ";
					}
									
				}

				echo"
					</div>
					</center>
				";
			}
		?>
		<div class="col-sm-8">
			<div style='background-color: #e6e6e6;text-align: center; border-radius: 5px; height:200px; width:450px; float:left; margin-right: 5px;'>

				<?php 

					$get_following = "SELECT * FROM follow WHERE follower_id = '$user_id'";
					$run_following = mysqli_query($con, $get_following); 
					$num_following = mysqli_num_rows($run_following);

					$num_scouted = $num_following-1; //since the user is following himself!

			 ?>

				<a href='scouting.php?u5Nm=<?php echo"$user_name" ?>' style='float:right; margin-top:10px; margin-right:10px; color: #fd4720;'>View all</a>
				<h3><strong>People <?php echo "$f_name"; ?> is Scouting <?php echo "($num_scouted)"; ?></strong></h3>

				<?php

					while($row_following = mysqli_fetch_array($run_following)){


						$scouted_user = $row_following['followed_id'];

						$get_scouted =  "SELECT * FROM users WHERE user_id='$scouted_user' LIMIT 9";

						$run_scouted = mysqli_query($con, $get_scouted);

						$row_scouted = mysqli_fetch_array($run_scouted);

						$scouted_fname = $row_scouted['f_name'];
						$scouted_lname = $row_scouted['l_name'];
						$scouted_uname = $row_scouted['user_name'];
						$scouted_image = $row_scouted['user_image'];


						if($user_id != $scouted_user){
							
							echo"	

							<img class='img-circle' src='users/$scouted_image' width='30' height='30'><a href='user_profile.php?u5Nm=$scouted_uname' style='margin-right:20px; color: #fd4720;'> $scouted_fname $scouted_lname</a>


							";
						}


					}

				?>
			</div>

			<div style='background-color: #e6e6e6;text-align: center; border-radius: 5px; height:200px; width:450px; float:left;'>
				<?php 

					global $con;

					$get_followers = "SELECT * FROM follow WHERE followed_id = '$user_id'";
					$run_followers = mysqli_query($con, $get_followers); 
					$num_followers = mysqli_num_rows($run_followers);

					$num_scouting = $num_followers-1;

				 ?>
				<a href='scouted_by.php?u5Nm=<?php echo"$user_name" ?>' style='float:right; margin-top:10px; margin-right:10px;  color: #fd4720;'>View all</a>
				<h3><strong>People Scouting <?php echo "$f_name ($num_scouting)"; ?></strong></h3>

				<?php

					while($row_followers = mysqli_fetch_array($run_followers)){


						$scouting_user = $row_followers['follower_id'];

						$get_scouting =  "SELECT * FROM users WHERE user_id='$scouting_user' LIMIT 9";

						$run_scouting = mysqli_query($con, $get_scouting);

						$row_scouting = mysqli_fetch_array($run_scouting);

						$scouting_fname = $row_scouting['f_name'];
						$scouting_lname = $row_scouting['l_name'];
						$scouting_uname = $row_scouting['user_name'];
						$scouting_image = $row_scouting['user_image'];


						if($user_id != $scouting_user){
							
							echo"	

							<img class='img-circle' src='users/$scouting_image' width='30' height='30'><a href='user_profile.php?u5Nm=$scouting_uname' style='margin-right:20px; color: #fd4720;'> $scouting_fname $scouting_lname</a>


							";
						}


					}

				?>
				
			</div>

		</div>
		<script type="text/javascript">

			var unm = "<?php echo $u_name ?>";
			
			setInterval(function(){
				var $container = $('#container');
				var url = 'myuser_profile.php?u5Nm='+unm;

				$.ajax(url).done(function(response){
					$container.html(response);
				});
			}, 1000)
		</script>
		<div id="container">
		
		</div>
	</div>
	</div>
	<div id='myModal' class='modal fade' role='dialog'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal'>&times;</button>
										<h4 class='modal-title'>Recommend Yourself</h4>
									</div>
									<div class='modal-body'>
										<form action="" method="post" id="f" enctype="multipart/form-data">
											<input type="checkbox" name="via_email" onclick = "javascript:emailCheck();" value="via_email" id="yesCheck"> Via email
											<input type="checkbox" name="via_talsgrad_messenger" onclick = "javascript:talsmsgCheck();" value="via_talsgrad_messenger" id="noCheck"> Via talsgrad messenger 

											<div id="ifYes" style="display:none"> Please Input recipient's email address:<br><br>
												Email Address: <input type="text" id = "via_email" name="recepient_email"><br><br>
											</div>

											<div id="ifNo" style="display:none"> Please Add Recipient:<br><br>
												Recipient: <input type="text" id = "via_talsgrad_messenger" name="talsgrad_messenger"><br><br>
												<div id="userList"></div> 
											</div>
											<div id="other_inputs" class="col-sm-12">
												Subject: <input type="text" id = "subject" name="sub" placeholder="Add a subject!"><br><br>
												Message: <textarea class="form-control" id="message" rows="4" name="msg" placeholder="Add a message!"></textarea><br>
												<button id='send' style="background-color: #fd4720;" name='send_recommendation' class='btn btn-info' align='right'>SEND</button>
											</div>
										</form>
									</div>
									<div class='modal-footer'>
										<button type='button' style="background-color: #232746; color: white;" class='btn btn-default' data-dismiss='modal'>Close</button>
									</div>
								</div>
							</div>

							<?php

									$url = $_SERVER['REQUEST_URI'];


									if(isset($_POST["send_recommendation"])){
										//if the via email
										if($_POST["recepient_email"]){
													// Checking For Blank Fields..
											if($_POST["recepient_email"]==""||$_POST["sub"]==""||$_POST["msg"]==""){
												echo "<script>alert('Fill all necessary Fields')</script>";
												echo "<script>window.open('home.php', '_self')</script>";
											}else{
												// Check if the "Sender's Email" input field is filled out
												$recepient_email=$_POST['recepient_email'];
												// Sanitize E-mail Address
												$recepient_email =filter_var($recepient_email, FILTER_SANITIZE_EMAIL);
												// Validate E-mail Address
												$recepient_email= filter_var($recepient_email, FILTER_VALIDATE_EMAIL);
										
												if (!$recepient_email){
													echo "Invalid receiver's Email";
												}
										else{
											$email2 = $user;
											$subject = $_POST['sub'];
											$msg = $_POST['msg'];
											$headers = 'From:'. $email2 . "rn"; // Sender's Email
											$headers .= 'Cc:'. $email2 . "rn"; // Carbon copy to Sender
											// Message lines should not exceed 70 characters (PHP rule), so wrap it
											$message = $msg.'

												The recommended person is:
											' .$url;
											// Send Mail By PHP Mail Function
											$send_mail = mail($recepient_email, $subject, $message, $headers);
											#echo "Your recommendation has been sent successfuly ! Thank you for your feedback";
										}
									} 

									if($send_mail){
													//get sender i.e current user's details from the session variable!
											$user = $_SESSION['user_email'];
											$get_user = "SELECT * FROM users WHERE email='$user'";
											$run_user = mysqli_query($con,$get_user);
											$row = mysqli_fetch_array($run_user);
											$sender_id = $row['user_id'];

											$insert1 = "insert into recommendations (recommender_id, recommended, receiver, date) values ('$sender_id', '$url', '$recepient_email', NOW())";
											$run_insert1 = mysqli_query($con, $insert1);

											if($insert1){

												//get user recommended from $url
												$parts = explode('=', $url);

												$recommended_uname = $parts[count($parts)-1];
												$getrec_id = "SELECT user_id from users WHERE user_name='$recommended_uname'";
												$run_recid = mysqli_query($con, $getrec_id);
												$row_rec = mysqli_fetch_array($run_recid);

												$recommended_id = $row_rec['user_id'];

												//notify
												$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$sender_id', '$recommended_id', '$sender_id', 'recommend', 'unread', NOW())";

												$run_notify = mysqli_query($con, $notify);

												if($run_notify){

													#echo "<script>alert('Your recommendation has been sent successfuly ! Thank you for your recommendation')</script>";
													echo "<script>window.open('user_profile.php?u5Nm=$recommended_uname', '_self')</script>";

												}

											}

									} else{
											echo "<script>alert(' Failed to connect to mailserver at localhost port 25, verify your SMTP and smtp_port setting in php.ini or use ini_set()!')</script>";
											echo "<script>window.open('user_profile.php?u5Nm=$user_name', '_self')</script>";
												}

									}else{ //then it's via messenger
											if($_POST["talsgrad_messenger"]==""||$_POST["sub"]==""||$_POST["msg"]==""){
												echo "<script>alert('Fill all necessary Fields')</script>";
												echo "<script>window.open('user_profile.php?u5Nm=$user_name', '_self')</script>";
											}else{
												//send via messenger
												//get receiver
													$user = $_POST['talsgrad_messenger'];

								           			$parts = explode('=', $user);

													$receiver_id = $parts[count($parts)-1];

													#$search_query = htmlentities($_GET['talsgrad_messenger']);
													#$get_receiver = "SELECT * FROM users WHERE f_name like '%$search_query%' OR l_name like '%$search_query%' OR user_name like '%search_query%'";

													#$run_receiver = mysqli_query($con, $get_receiver);

													#$row_receiver=mysqli_fetch_array($run_receiver);

													#$receiver_id = $row_user['user_id'];

													//get message details, concatenate user message input with $url variable
													$msg = $_POST['msg'];
													$message = $msg.'

									
													' .$url;

													//get sender i.e current user's details from the session variable!
													$user = $_SESSION['user_email'];
													$get_user = "SELECT * FROM users WHERE email='$user'";
													$run_user = mysqli_query($con,$get_user);
													$row = mysqli_fetch_array($run_user);
													$sender_id = $row['user_id'];

													//insert details in the db's user_messages table. Receipient will receive email!
													$insert = "insert into user_messages(user_to, user_from, msg_body, date, msg_seen) values ('$receiver_id', '$sender_id', '$message', NOW(), 'no')";

													$run_insert = mysqli_query($con, $insert);
											}
											
										}

										if($run_insert){
													$insert1 = "insert into recommendations (recommender_id, recommended, receiver, date) values ('$sender_id', '$url', '$receiver_id', NOW())";
													$run_insert1 = mysqli_query($con, $insert1);

													if($insert1){

														//get user recommended from $url
														$parts = explode('=', $url);

														$recommended_uname = $parts[count($parts)-1];
														$getrec_id = "SELECT user_id from users WHERE user_name='$recommended_uname'";
														$run_recid = mysqli_query($con, $getrec_id);
														$row_rec = mysqli_fetch_array($run_recid);

														$recommended_id = $row_rec['user_id'];

														//notify
														$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$sender_id', '$recommended_id', '$sender_id', 'recommend', 'unread', NOW())";

														$run_notify = mysqli_query($con, $notify);

														if($run_notify){

															#echo "<script>alert('Thank you for your recommendation! It has been sent!')</script>";
															echo "<script>window.open('user_profile.php?u5Nm=$recommended_uname', '_self')</script>";

														}

													}

												}

									}
								?>
	</div>
</div>
<?php } ?>

<?php 
	
				if(isset($_GET['u5Nm'])){
				global $con;

				$name = $_GET['u5Nm'];

				$select = "SELECT * FROM users WHERE user_name='$name'";
				$run = mysqli_query($con, $select);
				$row = mysqli_fetch_array($run);

				$user_id = $row['user_id'];
				$image = $row['user_image'];
				$f_name = $row['f_name'];
				$l_name = $row['l_name'];
				$describe_user = $row['describe_user'];
				$country = $row['user_country'];
				$gender = $row['user_gender'];
				$register_date = $row['user_reg_date'];

				$user = $_SESSION['user_email'];
				$get_user = "SELECT * FROM users WHERE email='$user'";
				$run_user = mysqli_query($con, $get_user);
				$row = mysqli_fetch_array($run_user);

				$userown_id = $row['user_id'];

				if($user_id == $userown_id){
					
				}else{

					echo "<button class='open-button' onclick='openForm()''><img class='img-circle' src='users/$image' width='30' height='30'> Discuss with $f_name $l_name</button>";				
				}
			}

 ?>

<div class="chat-popup" id="myForm">

<?php 
	
				if(isset($_GET['u5Nm'])){
				global $con;

				$name = $_GET['u5Nm'];

				$select = "SELECT * FROM users WHERE user_name='$name'";
				$run = mysqli_query($con, $select);
				$row = mysqli_fetch_array($run);

				$user_id = $row['user_id'];
				$image = $row['user_image'];
				$f_name = $row['f_name'];
				$l_name = $row['l_name'];
				$describe_user = $row['describe_user'];
				$country = $row['user_country'];
				$gender = $row['user_gender'];
				$register_date = $row['user_reg_date'];

				$user = $_SESSION['user_email'];
				$get_user = "SELECT * FROM users WHERE email='$user'";
				$run_user = mysqli_query($con, $get_user);
				$row = mysqli_fetch_array($run_user);

				$userown_id = $row['user_id'];
			}

 ?>


  <form action="" method="post" class="form-container">
    <h5><?php echo "Send $f_name $l_name a Message!";  ?></h5>

    <div class='load_msg' id='scroll_messages'>
			<?php
				$sel_msg = "SELECT * FROM user_messages WHERE (user_to='$user_id' AND user_from='$userown_id') OR (user_from='$user_id' AND user_to='$userown_id') ORDER by 1 ASC";
				$run_msg = mysqli_query($con, $sel_msg);

				while($row_msg = mysqli_fetch_array($run_msg)){

					$user_to = $row_msg['user_to'];
					$user_from = $row_msg['user_from'];
					$msg_body = $row_msg['msg_body'];
					$msg_date = $row_msg['date'];
					?>

					<div id='loaded_msg'>
						<p><?php if($user_to == $user_id AND $user_from == $userown_id){echo"<div class='message' id='blue' data-toggle='tooltip' title='$msg_date'>$msg_body</div><br><br><br>";} else if($user_from == $user_id AND $user_to == $userown_id){echo"<div class='message' id='green'data-toggle='tooltip' title='$msg_date'>$msg_body</div><br><br><br>";}?></p>
					</div>

					<?php
				}
			?>
		</div>

    <textarea placeholder="Type message.." name="msg" required></textarea>

    <button type="button" style="background-color: #fd4720;" class="btn cancel" onclick="closeForm()">Close</button>
    <button type="submit" name="submit_chat" class="btn" style="background-color: #232746;">Send</button>

    <?php 

    	if(isset($_POST['submit_chat'])){

								global $con;

								$receiver_id = $user_id;

								$user = $_SESSION['user_email'];
								$get_user = "SELECT * FROM users WHERE email='$user'";
								$run_user = mysqli_query($con,$get_user);
								$row = mysqli_fetch_array($run_user);
								$sender_id = $row['user_id'];




								$chat_msg = htmlentities($_POST['msg']);

								$msg = $chat_msg;

								if($msg != ""){
									$insert = "insert into user_messages(user_to, user_from, msg_body, date, msg_seen) values ('$receiver_id', '$sender_id', '$msg', NOW(), 'no')";

									$run_insert = mysqli_query($con, $insert);

									if($run_insert){

										echo "<meta http-equiv='refresh' content='0'>";

									}
								}
							}

     ?>


  </form>
</div>
 <script>  
 $(document).ready(function(){  
      $('#via_talsgrad_messenger').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"searchdb.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#userList').fadeIn();  
                          $('#userList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#via_talsgrad_messenger').val($(this).text());  
           $('#userList').fadeOut();  
      });  
 });  
 </script>  
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<script> //not working! why? Keep scroll bar at the buttom!
	var div = document.getElementById("scroll_messages");
	div.scrollTop = div.scrollHeight;
</script>
</body>
</html>