<?php

$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

//function for inserting post

function insertPost(){
	if(isset($_POST['sub'])){
		global $con;
		global $user_id;

		$content = htmlentities($_POST['content']);
		$upload_image = $_FILES['upload_image']['name'];
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);
		$bazaar = $_POST['price'];

		if(strlen($content) > 250){
			echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
			echo "<script>window.open('home.php', '_self')</script>";
		}else{
			if($bazaar != ''){
				if(strlen($upload_image) >= 1 && strlen($content) >= 1){
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
				$insert = "insert into posts (user_id, post_content, upload_image, post_date, bazaar) values('$user_id', '$content', '$upload_image.$random_number', NOW(), 'yes')";

				$run = mysqli_query($con, $insert);

				$get_post_id = "SELECT * FROM posts WHERE user_id = '$user_id' AND post_content = '$content'";

				$run_post_id = mysqli_query($con, $get_post_id);
				$row_post_id = mysqli_fetch_array($run_post_id);
				$post_id = $row_post_id['post_id'];

				$insert1 = "insert into bazaar (post_id, user_id, price, date) values('$post_id', '$user_id', '$bazaar', NOW())";

				$run1 = mysqli_query($con, $insert1);

				if($run && $run1){

					$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_id', '$user_id', '$user_id', 'post', 'unread', NOW())";

					$run_notify = mysqli_query($con, $notify);

					#echo "<script>alert('Your Post updated a moment ago!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";

					$update = "update users set posts='yes' where user_id='$user_id'";
					$run_update = mysqli_query($con, $update);
				}

				exit();
			}else{
				if($upload_image=='' && $content == ''){
					echo "<script>alert('Error Occured while uploading!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";
				}else{
					if($content==''){
						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
						$insert = "insert into posts (user_id,post_content,upload_image,post_date, bazaar) values ('$user_id','No','$upload_image.$random_number',NOW(), 'yes')";

						$run = mysqli_query($con, $insert);

						$get_post_id = "SELECT * FROM posts WHERE user_id = '$user_id' AND post_content = '$content'";

						$run_post_id = mysqli_query($con, $get_post_id);
						$row_post_id = mysqli_fetch_array($run_post_id);
						$post_id = $row_post_id['post_id'];

						$insert1 = "insert into bazaar (post_id, user_id, price, date) values('$post_id', '$user_id', '$bazaar', NOW())";

						$run1 = mysqli_query($con, $insert1);


						if($run && $run1){

							$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_id', '$user_id', '$user_id', 'post', 'unread', NOW())";

							$run_notify = mysqli_query($con, $notify);

							#echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}

						exit();
					}else{
						$insert = "insert into posts (user_id, post_content, post_date, bazaar) values('$user_id', '$content', NOW(), 'yes')";

						$run = mysqli_query($con, $insert);

						$get_post_id = "SELECT * FROM posts WHERE user_id = '$user_id' AND post_content = '$content'";

						$run_post_id = mysqli_query($con, $get_post_id);
						$row_post_id = mysqli_fetch_array($run_post_id);
						$post_id = $row_post_id['post_id'];

						$insert1 = "insert into bazaar (post_id, user_id, price, date) values('$post_id', '$user_id', '$bazaar', NOW())";

						$run1 = mysqli_query($con, $insert1);


						if($run && $run1){

							//notify (the user who made the post is the other id, cos the they will be linked to that user's page!)
							$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_id', '$user_id', '$user_id', 'post', 'unread', NOW())";

							$run_notify = mysqli_query($con, $notify);

							#echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}
					}
				}
			}
			}else{
				if(strlen($upload_image) >= 1 && strlen($content) >= 1){
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
				$insert = "insert into posts (user_id, post_content, upload_image, post_date, bazaar) values('$user_id', '$content', '$upload_image.$random_number', NOW(), 'no')";

				$run = mysqli_query($con, $insert);

				if($run){

					//notify (the user who made the post is the other id, cos the they will be linked to that user's page!)
					$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_id', '$user_id', '$user_id', 'post', 'unread', NOW())";

					$run_notify = mysqli_query($con, $notify);

					#echo "<script>alert('Your Post updated a moment ago!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";

					$update = "update users set posts='yes' where user_id='$user_id'";
					$run_update = mysqli_query($con, $update);
				}

				exit();
			}else{
				if($upload_image=='' && $content == ''){
					echo "<script>alert('Error Occured while uploading!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";
				}else{
					if($content==''){
						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
						$insert = "insert into posts (user_id,post_content,upload_image,post_date, bazaar) values ('$user_id','No','$upload_image.$random_number',NOW(), 'no')";
						$run = mysqli_query($con, $insert);

						if($run){

							//notify (the user who made the post is the other id, cos the they will be linked to that user's page!)
							$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_id', '$user_id', '$user_id', 'post', 'unread', NOW())";

							$run_notify = mysqli_query($con, $notify);



								#echo "<script>alert('Your Post updated a moment ago!')</script>";
								echo "<script>window.open('home.php', '_self')</script>";


							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}

						exit();
					}else{
						$insert = "insert into posts (user_id, post_content, post_date, bazaar) values('$user_id', '$content', NOW(), 'no')";
						$run = mysqli_query($con, $insert);

						if($run){

							//notify (the user who made the post is the other id, cos the they will be linked to that user's page!)
							$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_id', '$user_id', '$user_id', 'post', 'unread', NOW())";

							$run_notify = mysqli_query($con, $notify);



								#echo "<script>alert('Your Post updated a moment ago!')</script>";
								echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}
					}
				}
			}
			}
		}
	}
}

function get_posts(){ //no more in use for now!
	global $con;

	//get current user to get followers! 

	$user = $_SESSION['user_email'];
	$get_user = "SELECT * FROM users WHERE email='$user'"; 
	$run_user = mysqli_query($con,$get_user);
	$row=mysqli_fetch_array($run_user);
					
	$currentuser_id = $row['user_id']; 
	$user_nom = $row['user_name']; 


		$get_posts = "SELECT * FROM posts ORDER by post_id DESC";
		$run_posts = mysqli_query($con, $get_posts);

		while($row_posts = mysqli_fetch_array($run_posts)){

			//get_followers

			$post_id = $row_posts['post_id'];

			$get_likes = "SELECT * FROM likes WHERE post_id = '$post_id'";
			$run_likes = mysqli_query($con, $get_likes);
			$likes = mysqli_num_rows($run_likes);
			

			$user_id = $row_posts['user_id'];
			$content = substr($row_posts['post_content'], 0,40);
			$upload_image = $row_posts['upload_image'];
			$post_date = $row_posts['post_date'];
			$bazaar = $row_posts['bazaar'];

			$user = "SELECT * from users where user_id='$user_id' AND posts='yes'";
			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);

			$user_name = $row_user['user_name'];
			$user_fname = $row_user['f_name'];
			$user_lname = $row_user['l_name'];
			$user_image = $row_user['user_image'];

			$get_follow = "SELECT followed_id FROM follow WHERE follower_id = '$currentuser_id' AND followed_id = '$user_id'";
			$run_follow = mysqli_query($con, $get_follow);

			$is_follow = mysqli_num_rows($run_follow);


			if($is_follow == 1){ // a result is returned!
			
			//now displaying posts from database

			if ($bazaar == "yes") {
				if($content=="No" && strlen($upload_image) >= 1){
					echo"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
							<a href='like.php?type=p0S57tpHm&23U89o0iD=$post_id&SQrY=0' style='float:left; color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left; color: #fd4720;'>$likes</a><br>

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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
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
							<a href='like.php?type=p0S57tpHm&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							<a href='like.php?type=p0S57tpHm&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";
				}
			}else{
				if($content=="No" && strlen($upload_image) >= 1){
					echo"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><small style='color:black;'>Not Listed</small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='like.php?type=p0S57tpHm&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><small style='color:black;'>Not Listed</small></h4>
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
							<a href='like.php?type=p0S57tpHm&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><small style='color:black;'>Not Listed</small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							<a href='like.php?type=p0S57tpHm&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";
				}
			}
		}

	}

}

function single_post(){

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

		$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_fname = $row_user['f_name'];
		$user_lname = $row_user['l_name'];
		$user_fname = $row_user['f_name'];
		$user_lname = $row_user['l_name'];
		$user_image = $row_user['user_image']; 

		$user_com = $_SESSION['user_email'];

		$get_com = "SELECT * FROM users WHERE email='$user_com'";

		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);

		$user_com_id = $row_com['user_id'];
		$user_com_name = $row_com['user_name'];

		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];
		}

		$user = $_SESSION['user_email'];
		$get_user = "select user_name from users where email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);
		
		$user_nom = $row['user_name'];


		$get_likes = "SELECT * FROM likes WHERE post_id = '$post_id'";
		$run_likes = mysqli_query($con, $get_likes);
		$likes = mysqli_num_rows($run_likes);


		$get_user = "SELECT post_id FROM posts WHERE post_id='$post_id'";
		$run_user = mysqli_query($con, $get_user);
		$row = mysqli_fetch_array($run_user);

		$p_id = $row['post_id'];

		$output1 = date("d - M - Y", strtotime($post_date));
		$output2 = date("H:i", strtotime($post_date));

		if($p_id != $post_id){
			echo "<script>alert('ERROR')</script>";
			echo "<script>window.open('home.php', '_self')</script>";
		}else{
			if($bazaar == "yes"){
				if($content=="No" && strlen($upload_image) >= 1){
					echo"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Added an item on <strong>$output1</strong> at <strong>$output2</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='like.php?type=po56stsin0G&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Added an item on <strong>$output1</strong> at <strong>$output2</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
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
							<a href='like.php?type=po56stsin0G&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Added an item on <strong>$output1</strong> at <strong>$output2</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							<a href='like.php?type=po56stsin0G&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";
				} //else condition ending

				include("comments.php");

					echo "
					<div class='row'>
						<div class='col-md-6 col-md-offset-3'>
							<div class='panel panel-info'>
								<div class='panel-body'>
									<form action='' method='post' class='form-inline'>
									<textarea placeholder='Write your comment here!' class='pb-cmnt-textarea' name='comment'></textarea>
									<button class='btn btn-info pull-right' name='reply' style='background-color: #fd4720;'>Comment</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					";

							if(isset($_POST['reply'])){
								$comment = htmlentities($_POST['comment']);

								if($comment == ""){
									echo "<script>alert('Please write your comment!')</script>";
									echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
								}else{

									$insert = "insert into comments (post_id, user_id, comment, comment_author, date) values('$post_id', '$user_id', '$comment', '$user_com_id', NOW())";

									$run = mysqli_query($con, $insert);

								}

									//notify
									$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_com_id', '$user_id', '$post_id', 'comment', 'unread', NOW())";

									$run_notify = mysqli_query($con, $notify);

									#echo "<script>alert('Your comment has been added!')</script>";
									echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
							}
			}

			else{
					if($content=="No" && strlen($upload_image) >= 1){
					echo"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Added an item on <strong>$output1</strong> at <strong>$output2</strong></small></h4>
									<h4><small style='color:black;'>Not Listed</small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='like.php?type=po56stsin0G&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Added an item on <strong>$output1</strong> at <strong>$output2</strong></small></h4>
									<h4><small style='color:black;'>Not Listed</small></h4>
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
							<a href='like.php?type=po56stsin0G&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Added an item on <strong>$output1</strong> at <strong>$output2</strong></small></h4>
									<h4><small style='color:black;'>Not Listed</small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							<a href='like.php?type=po56stsin0G&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";
				} //else condition ending

				include("comments.php");

					echo "
					<div class='row'>
						<div class='col-md-6 col-md-offset-3'>
							<div class='panel panel-info'>
								<div class='panel-body'>
									<form action='' method='post' class='form-inline'>
									<textarea placeholder='Write your comment here!' class='pb-cmnt-textarea' name='comment'></textarea>
									<button class='btn btn-info pull-right' name='reply' style='background-color: #fd4720;'>Comment</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					";

							if(isset($_POST['reply'])){
								$comment = htmlentities($_POST['comment']);

								if($comment == ""){
									echo "<script>alert('Please write your comment!')</script>";
									echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
								}else{
									$insert = "insert into comments (post_id, user_id, comment, comment_author, date) values('$post_id', '$user_id', '$comment', '$user_com_id', NOW())";

									$run = mysqli_query($con, $insert);

									//notify
									$notify = "insert into notifications (user_from_id, user_to_id, other_id, type, status, date) values('$user_com_id', '$user_id', '$post_id', 'comment', 'unread', NOW())";

									$run_notify = mysqli_query($con, $notify);

									#echo "<script>alert('Your comment has been added!')</script>";
									echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
								}
							}

			}

		}

	}
}



	function user_posts(){ // no more in use for now!

		global $con;

		if(isset($_GET['u5Nm'])){
			$u_name = $_GET['u5Nm'];

			$get_u_id = "SELECT user_id FROM users WHERE user_name = '$u_name'";
			$run_get_u_id = mysqli_query($con, $get_u_id);
			$row_u_id = mysqli_fetch_array($run_get_u_id);

			$u_id = $row_u_id['user_id'];

		}
		
		$get_posts = "SELECT * FROM posts WHERE user_id='$u_id' ORDER by 1 DESC LIMIT 100";

		$run_posts = mysqli_query($con, $get_posts);

		while ($row_posts=mysqli_fetch_array($run_posts)) {
			
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$content = $row_posts['post_content'];
			$upload_image = $row_posts['upload_image'];
			$post_date = $row_posts['post_date']; 
			$bazaar = $row_posts['bazaar'];

			$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes'";

			$run_user = mysqli_query($con, $user);
			$row_user = mysqli_fetch_array($run_user);

			$user_name = $row_user['user_name'];
			$user_fname = $row_user['f_name'];
			$user_lname = $row_user['l_name'];
			$user_fname = $row_user['f_name'];
			$user_lname = $row_user['l_name'];
			$user_image = $row_user['user_image'];

			if(isset($_GET['u_id'])){
				$u_id = $_GET['u_id'];
			}
			$getuser = "SELECT email FROM users WHERE user_id='$u_id'";
			$run_user = mysqli_query($con, $getuser);
			$row = mysqli_fetch_array($run_user);

			$user_email = $row['email'];

			$user = $_SESSION['user_email'];
			$get_user = "SELECT * FROM users WHERE email='$user'";
			$run_user = mysqli_query($con, $get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id = $row['user_id'];
			$u_email = $row['email'];
			$user_nom = $row['user_name'];

			$get_likes = "SELECT * FROM likes WHERE post_id = '$post_id'";
			$run_likes = mysqli_query($con, $get_likes);
			$likes = mysqli_num_rows($run_likes);

			if($u_email != $user_email){
				echo "<script>window.open('my_post.php?u_id=$user_id', '_self')</script>";
			}else{

				if($bazaar == 'yes'){
					if($content=="No" && strlen($upload_image) >= 1){
						echo"
						<div class='row'>
							<div class='col-sm-3'>
							</div>
							<div id='posts' class='col-sm-6'>
								<div class='row'>
									<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
									</div>
									<div class='col-sm-6'>
										<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
										<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
										<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
									</div>
									<div class='col-sm-4'>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-12'>
										<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
									</div>
								</div><br>
								<a href='like.php?type=pOstuMyiT&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
								<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
								<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
									</div>
									<div class='col-sm-6'>
										<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
										<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
										<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
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
								<a href='like.php?type=pOstuMyiT&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
								<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
								<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
									</div>
									<div class='col-sm-6'>
										<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
										<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
										<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
									</div>
									<div class='col-sm-4'>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-12'>
										<h3><p>$content</p></h3>
									</div>
								</div><br>
								<a href='like.php?type=pOstuMyiT&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
								<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
								<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
							</div>
							<div class='col-sm-3'>
							</div>
						</div><br><br>
						";
					}
				}
				else{
					if($content=="No" && strlen($upload_image) >= 1){
						echo"
						<div class='row'>
							<div class='col-sm-3'>
							</div>
							<div id='posts' class='col-sm-6'>
								<div class='row'>
									<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
									</div>
									<div class='col-sm-6'>
										<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
										<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
										<h4><small style='color:black;'>Not Listed</small></h4>
									</div>
									<div class='col-sm-4'>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-12'>
										<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
									</div>
								</div><br>
								<a href='like.php?type=pOstuMyiT&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
								<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
								<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
									</div>
									<div class='col-sm-6'>
										<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
										<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
										<h4><small style='color:black;'>Not Listed</small></h4>
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
								<a href='like.php?type=pOstuMyiT&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
								<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
								<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
									</div>
									<div class='col-sm-6'>
										<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
										<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
										<h4><small style='color:black;'>Not Listed</small></h4>
									</div>
									<div class='col-sm-4'>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-12'>
										<h3><p>$content</p></h3>
									</div>
								</div><br>
								<a href='like.php?type=pOstuMyiT&23U89o0iD=$post_id&SQrY=0' style='float:left;color: #fd4720;'>Like</a>
								<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
								<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
							</div>
							<div class='col-sm-3'>
							</div>
						</div><br><br>
						";
					}
				}
			}
		}
	}


	function results(){ //no more in use for now!
		global $con;

		if(isset($_GET['search'])){
			$search_query = htmlentities($_GET['user_query']);
		}

		$get_posts = "SELECT * FROM posts WHERE post_content like '%$search_query%' OR upload_image like '%$search_query%' ORDER BY post_id DESC";

		$run_posts = mysqli_query($con, $get_posts);

		while ($row_posts=mysqli_fetch_array($run_posts)) {
			
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$content = $row_posts['post_content'];
			$upload_image = $row_posts['upload_image'];
			$post_date = $row_posts['post_date']; 
			$bazaar = $row_posts['bazaar'];

			$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes'";

			$run_user = mysqli_query($con, $user);
			$row_user = mysqli_fetch_array($run_user);

			$user_name = $row_user['user_name'];
			$user_fname = $row_user['f_name'];
			$user_lname = $row_user['l_name'];
			$first_name = $row_user['f_name'];
			$last_name = $row_user['l_name'];
			$user_image = $row_user['user_image'];

			$user = $_SESSION['user_email'];
			$get_user = "select user_name from users where email='$user'";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);
			
			$user_nom = $row['user_name'];

			//get likes
			$get_likes = "SELECT * FROM likes WHERE post_id = '$post_id'";
			$run_likes = mysqli_query($con, $get_likes);
			$likes = mysqli_num_rows($run_likes);

			//display posts

			if($bazaar == 'yes'){

				if($content=="No" && strlen($upload_image) >= 1){
					echo"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='like.php?type=sEcReuT&23U89o0iD=$post_id&SQrY=$search_query' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
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
							<a href='like.php?type=sEcReuT&23U89o0iD=$post_id&SQrY=$search_query' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='bazaar.php?u5Nm=$user_nom'>Listed on Bazaar</a></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							<a href='like.php?type=sEcReuT&23U89o0iD=$post_id&SQrY=$search_query' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";
				}
			}
			else{
				if($content=="No" && strlen($upload_image) >= 1){
					echo"
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><small style='color:black;'>Not Listed</small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								</div>
							</div><br>
							<a href='like.php?type=sEcReuT&23U89o0iD=$post_id&SQrY=$search_query' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><small style='color:black;'>Not Listed</small></h4>
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
							<a href='like.php?type=sEcReuT&23U89o0iD=$post_id&SQrY=$search_query' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
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
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration:none; cursor:pointer;color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>$user_fname $user_lname</a></h3>
									<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
									<h4><small style='color:black;'>Not Listed</small></h4>
								</div>
								<div class='col-sm-4'>
								</div>
							</div>
							<div class='row'>
								<div class='col-sm-12'>
									<h3><p>$content</p></h3>
								</div>
							</div><br>
							<a href='like.php?type=sEcReuT&23U89o0iD=$post_id&SQrY=$search_query' style='float:left;color: #fd4720;'>Like</a>
							<a href='liked_by.php?liK34Di=$post_id' style='float:left;color: #fd4720;'>$likes</a><br>
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info' style='background-color: #fd4720;'>Comment</button></a><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
					";
				}
			}

		}
	}

	function search_user(){
		global $con;

		if(isset($_GET['search_user_btn'])){
			$search_query = htmlentities($_GET['search_user']);
			$get_user = "SELECT * FROM users WHERE f_name like '%$search_query%' OR l_name like '%$search_query%' OR user_name like '%search_query%'";
		}
		else{
			$get_user = "SELECT * FROM users";
		}

		$run_user = mysqli_query($con, $get_user);

		while ($row_user=mysqli_fetch_array($run_user)) {

			$user_id = $row_user['user_id'];
			$f_name = $row_user['f_name'];
			$l_name = $row_user['l_name'];
			$user_name = $row_user['user_name'];
			$user_image = $row_user['user_image'];

			echo "
				<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div class='col-sm-6'>
						<div class='row' id='find_people'>
							<div class='col-sm-4'>
								<a href='user_profile.php?u5Nm=$user_name'>
								<img src='users/$user_image' width='150px' height='140px' title='$user_name' style='float:left; margin:1px;'/>
								</a>
							</div><br><br>
							<div class='col-sm-6'>
								<a style='text-decoration:none; cursor:pointer; color: #fd4720;' href='user_profile.php?u5Nm=$user_name'>
								<strong><h2>$f_name $l_name</h2></strong>
								</a>
							</div>
							<div class='col-sm-3'>
							</div>
						</div>
						<div class='col-sm-4'>
						</div>
					</div><br>
				</div>
			";
		}
	}

?>