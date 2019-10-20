<?php

$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
session_start();

echo "<div class='row'>
	<center><h2>Your Search Results</h2></center> ";

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

			$output1 = date("d - M - Y", strtotime($post_date));
			$output2 = date("H:i", strtotime($post_date));

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

echo "
</div>
";

 ?>