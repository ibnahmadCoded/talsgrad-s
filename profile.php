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
	?>
	<title><?php echo "Talsgrad: $user_fname $user_lname"; ?></title>
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
	#cover-img{
		height: 400px;
		width: 100%;
	}#profile-img{
		position: absolute;
		top: 160px;
		left: 40px;
	}
	#update_profile{
		position: relative;
		top: -33px;
		cursor: pointer;
		left: 93px;
		border-radius: 4px;
		background-color: rgba(0,0,0,0.1);
		transform: translate(-50%, -50%);
	}
	#button_profile{
		position: absolute;
		top: 82%;
		left: 50%;
		cursor: pointer;
		transform: translate(-50%, -50%);
	}
	#own_posts{
	background: #fff;
		box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		border-radius: 30px 30px 30px 30px;
		padding: 40px 50px;
}
#post_img{
	height: 300px;
	width: 100%;
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
	<div class="col-sm-2">	
	</div>
	<div class="col-sm-8">
		<?php
			echo"
			<div>
				<div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'></div>
				<form action='profile.php?u5Nm=$user_name' method='post' enctype='multipart/form-data'>

				<ul class='nav pull-left' style='position:absolute;top:10px;left:40px;'>
					<li class='dropdown'>
						<button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover</button>
						<div class='dropdown-menu'>
							<center>
							<p>Click <strong>Select Cover</strong> and then click the <br> <strong>Update Cover</strong></p>
							<label class='btn btn-info' style='background-color:#fd4720;'> Select Cover
							<input type='file' name='u_cover' size='60' />
							</label><br><br>
							<button name='submit' class='btn btn-info' style='background-color:#fd4720;'>Update Cover</button>
							</center>
						</div>
					</li>
				</ul>

				</form>
			</div>
			<div id='profile-img'>
				<img src='users/$user_image' alt='Profile' class='img-circle' width='180px' height='185px'>
				<form action='profile.php?u5Nm='$user_name' method='post' enctype='multipart/form-data'>

				<label id='update_profile'> Select Profile
				<input type='file' name='u_image' size='60' />
				</label><br><br>
				<button id='button_profile' name='update' class='btn btn-info' style='background-color:#fd4720;'>Update Profile</button>
				</form>
			</div><br>
			";
		?>
		<?php

			if(isset($_POST['submit'])){

				$u_cover = $_FILES['u_cover']['name'];
				$image_tmp = $_FILES['u_cover']['tmp_name'];
				$random_number = rand(1,100);

				if($u_cover==''){
					echo "<script>alert('Please Select Cover Image')</script>";
					echo "<script>window.open('profile.php?u5Nm=$user_name' , '_self')</script>";
					exit();
				}else{
					move_uploaded_file($image_tmp, "cover/$u_cover.$random_number");
					$update = "update users set user_cover='$u_cover.$random_number' where user_id='$user_id'";

					$run = mysqli_query($con, $update);

					if($run){
					echo "<script>alert('Your Cover Updated')</script>";
					echo "<script>window.open('profile.php?u5Nm=$user_name' , '_self')</script>";
					}
				}

			}

		?>
	</div>


	<?php
		if(isset($_POST['update'])){

				$u_image = $_FILES['u_image']['name'];
				$image_tmp = $_FILES['u_image']['tmp_name'];
				$random_number = rand(1,100);

				if($u_image==''){
					echo "<script>alert('Please Select Profile Image on clicking on your profile image')</script>";
					echo "<script>window.open('profile.php?u5Nm=$user_name' , '_self')</script>";
					exit();
				}else{
					move_uploaded_file($image_tmp, "users/$u_image.$random_number");
					$update = "update users set user_image='$u_image.$random_number' where user_id='$user_id'";

					$run = mysqli_query($con, $update);

					if($run){
					echo "<script>alert('Your Profile Updated')</script>";
					echo "<script>window.open('profile.php?u5Nm=$user_name' , '_self')</script>";
					}
				}

			}
	?>
	<div class="col-sm-2">
	</div>
</div>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-2" style="background-color: #e6e6e6;text-align: center;left: 0.8%;border-radius: 5px;">
		<?php
		echo"
			<center><h2><strong>About</strong></h2></center>
			<center><h4><strong>$first_name $last_name</strong></h4></center>
			<p><strong><i style='color:grey;'>$describe_user</i></strong></p><br>
			<p><strong>Relationship Status: </strong> $Relationship_status</p><br>
			<p><strong>Lives In: </strong> $user_country</p><br>
			<p><strong>Member Since: </strong> $register_date</p><br>
			<p><strong>Gender: </strong> $user_gender</p><br>
			<p><strong>Date of Birth: </strong> $user_birthday</p><br>
			<button type='button' data-toggle='modal' data-target='#myModal' name='recommend' class='btn btn-info' style='background-color:#fd4720;'>Recommend Yourself</button><br>
		";
		?>
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
										<button type='button' class='btn btn-default' data-dismiss='modal' style='background-color:#232742; color: white;'>Close</button>
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
													header("HTTP/1.0 204 No Content"); //don't refresh page!
													#echo "<script>window.open('profile.php?u5Nm=$user_name', '_self')</script>";

												}

											}

												} else{
													echo "<script>alert(' Failed to connect to mailserver at localhost port 25, verify your SMTP and smtp_port setting in php.ini or use ini_set()!')</script>";
													echo "<script>window.open('profile.php?u5Nm=$user_name', '_self')</script>";
												}

									}else{ //then it's via messenger
											//send via messenger
												//get receiver

											$user = $_POST['talsgrad_messenger'];

								           	$parts = explode('=', $user);

											$receiver_id = $parts[count($parts)-1];

											#$search_query = htmlentities($_GET['talsgrad_messenger']);
											#$get_receiver = "SELECT * FROM users WHERE f_name like '%$search_query%' OR l_name like '%$search_query%' OR user_name like '%search_query%'";

											#$run_receiver = mysqli_query($con, $get_receiver);

											#$row_receiver=mysqli_fetch_array($run_receiver);

											#$receiver_id = $row_user['user_id']; //show list of users when inputing reciever! if not, it won't get the message

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
															header("HTTP/1.0 204 No Content"); //don't refresh page!
															#echo "<script>window.open('profile.php?u5Nm=$user_name', '_self')</script>";

														}

													}

												}

									}
								?>
	</div>

	<div class="col-sm-6">

			<div style='background-color: #e6e6e6;text-align: center; border-radius: 5px; height:200px; width:360px; float:left; margin-right: 21px;'>
				<?php 

					global $con;

					$get_following = "SELECT * FROM follow WHERE follower_id = '$user_id' LIMIT 6";
					$run_following = mysqli_query($con, $get_following); 
					$num_following = mysqli_num_rows($run_following);

					$num_scouted = $num_following-1; //since the user is following himself!
				 ?>
				<a href='scouting.php?u5Nm=<?php echo"$user_name" ?>' style='float:right; margin-top:10px; margin-right:10px; color: #fd4720;'>View all</a>
				<h3><strong>People You Are Scouting <?php echo "($num_scouted)"; ?></strong></h3>

				<?php 

					while($row_following = mysqli_fetch_array($run_following)){


						$scouted_user = $row_following['followed_id'];

						$get_scouted =  "SELECT * FROM users WHERE user_id='$scouted_user'";

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

			<div style='background-color: #e6e6e6;text-align: center; border-radius: 5px; height:200px; width:360px; float:left; margin-bottom: 15px;'>

				<?php 

					global $con;

					$get_followers = "SELECT * FROM follow WHERE followed_id = '$user_id' LIMIT 6";
					$run_followers = mysqli_query($con, $get_followers); 
					$num_followers = mysqli_num_rows($run_followers);

					$num_scouting = $num_followers-1;
				 ?>
				<a href='scouted_by.php?u5Nm=<?php echo"$user_name" ?>' style='float:right; margin-top:10px; margin-right:10px; color: #fd4720;'>View all</a>
				<h3><strong>People Scouting You <?php echo "($num_scouting)"; ?></strong></h3>

				<?php

					while($row_followers = mysqli_fetch_array($run_followers)){


						$scouting_user = $row_followers['follower_id'];

						$get_scouting =  "SELECT * FROM users WHERE user_id='$scouting_user'";

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
		<?php 

			if(isset($_GET['u5Nm'])){
				$u_name = $_GET['u5Nm'];
			}

		?>
		<script type="text/javascript">

			var unm = "<?php echo $u_name ?>";
			
			setInterval(function(){
				var $container = $('#container');
				var url = 'my_profile.php?u5Nm='+unm;

				$.ajax(url).done(function(response){
					$container.html(response);
				});
			}, 1000)
		</script>

	<div id="container">
	
	</div>
	<div class="col-sm-2">
	</div>
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
</body>
</html>