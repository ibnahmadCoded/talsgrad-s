<?php 
	$get_id = $_GET['post_id'];

	$get_com = "SELECT * FROM comments WHERE post_id='$get_id' ORDER by 1 ASC";

	$run_com = mysqli_query($con, $get_com);

	while($row = mysqli_fetch_array($run_com)){
		$com = $row['comment'];
		$user_id = $row['comment_author'];
		$date = $row['date'];
		#$user_id = $row['user_id'];

		$get_user = "SELECT * FROM users WHERE user_id='$user_id'";
		$run_user = mysqli_query($con, $get_user);

		$row_user = mysqli_fetch_array($run_user);

		$fname = $row_user['f_name'];
		$lname = $row_user['l_name'];
		$user_name = $row_user['user_name'];
		$user_img = $row_user['user_image'];

		echo "
			<div class='row'>
				<div class='col-md-6 col-md-offset-3'>
					<div class='panel panel-info'>
					<div class='panel-body'>
						<div>
							<img src='users/$user_img' class='img-circle' width='30px' height='30px'>
							<a style='text-decoration:none; cursor:pointer;color: #fd4720; font-size: 19px; margin-right:13px;' href='user_profile.php?u5Nm=$user_name'>$fname $lname</a>commented on $date
							<p class='text-secondary' style='margin-left:5px;font-size:20px;'>$com</p>
						</div>
					</div>
					</div>
				</div>
			</div>
		";
	}
 ?>