<?php 
//this page isn't used anymore
$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
session_start();

echo "
<div class='row'>
		<div class='col-sm-12'>
			<center><h2>Comments</h2><br></center> ";

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

echo "
		</div>
	</div>
";

 ?>