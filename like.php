<?php 
include("includes/connection.php");
session_start();

if(isset($_GET['type'], $_GET['23U89o0iD'], $_GET['SQrY'])){

	$type = $_GET['type'];
	$id = (int)$_GET['23U89o0iD'];
	$search_query = $_GET['SQrY']; // this is for results.php page when posts are liked from that page!

	global $con;


		$user = $_SESSION['user_email'];
		$get_user = "select * from users where email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_id = $row['user_id'];
		$user_name = $row['user_name']; //get user name for user_posts page!


	switch($type){
		case 'p0S57tpHm': //from home page (in get_posts())

			$get_likes = "SELECT * FROM likes WHERE user_id='$user_id' AND post_id='$id' LIMIT 1";
			$run_likes = mysqli_query($con, $get_likes);
			$match = mysqli_num_rows($run_likes);

			$row_likes = mysqli_fetch_array($run_likes);
			$like_id = $row_likes['id'];

			if($match>0){
				//like already exists (delete from the likes table)

				$delete = "DELETE FROM likes WHERE id = '$like_id'";
				$run_delete = mysqli_query($con, $delete);

			}
			else{
				//like inexistent (add to to likes table)

				$insert_like = "INSERT INTO likes (user_id, post_id) VALUES ($user_id, $id);";
				$run_insert = mysqli_query($con, $insert_like);

				if($insert_like){

					//get post owner

					$get_post = "SELECT * FROM posts WHERE post_id = '$id'";
					$run_post = mysqli_query($con, $get_post);
					$row_post = mysqli_fetch_array($run_post);

					$postowner_id = $row_post['user_id'];

					//notify
					$insert_notification = "INSERT INTO notifications (user_from_id, user_to_id, other_id, type, status, date) VALUES ('$user_id','$postowner_id', '$id', 'like', 'unread', NOW())";
					$run_insert1 = mysqli_query($con, $insert_notification);
				}
			}

			header("HTTP/1.0 204 No Content");

			#echo "<script>window.open('home.php', '_self')</script>";
			
			break;

			case 'po56stsin0G': //singele posts (in single_posts())

				$get_likes = "SELECT * FROM likes WHERE user_id='$user_id' AND post_id='$id' LIMIT 1";
				$run_likes = mysqli_query($con, $get_likes);
				$match = mysqli_num_rows($run_likes);

				$row_likes = mysqli_fetch_array($run_likes);
				$like_id = $row_likes['id'];

				if($match>0){
					//like already exists (delete from the likes table)

					$delete = "DELETE FROM likes WHERE id = '$like_id'";
					$run_delete = mysqli_query($con, $delete);

				}
				else{
					//like inexistent (add to to likes table)

					$insert_like = "INSERT INTO likes (user_id, post_id) VALUES ($user_id, $id);";
					$run_insert = mysqli_query($con, $insert_like);

					if($insert_like){

						//get post owner

						$get_post = "SELECT * FROM posts WHERE post_id = '$id'";
						$run_post = mysqli_query($con, $get_post);
						$row_post = mysqli_fetch_array($run_post);

						$postowner_id = $row_post['user_id'];

						//notify
						$insert_notification = "INSERT INTO notifications (user_from_id, user_to_id, other_id, type, status, date) VALUES ('$user_id','$postowner_id', '$id', 'like', 'unread', NOW())";
						$run_insert1 = mysqli_query($con, $insert_notification);
					}
				}

				echo "<script>window.open('single.php?post_id=$id', '_self')</script>";
			
			break;

			case 'pOstuMyiT': //my posts page (in user_posts()!

				$get_likes = "SELECT * FROM likes WHERE user_id='$user_id' AND post_id='$id' LIMIT 1";
				$run_likes = mysqli_query($con, $get_likes);
				$match = mysqli_num_rows($run_likes);

				$row_likes = mysqli_fetch_array($run_likes);
				$like_id = $row_likes['id'];

				if($match>0){
					//like already exists (delete from the likes table)

					$delete = "DELETE FROM likes WHERE id = '$like_id'";
					$run_delete = mysqli_query($con, $delete);

				}
				else{
					//like inexistent (add to to likes table)

					$insert_like = "INSERT INTO likes (user_id, post_id) VALUES ($user_id, $id);";
					$run_insert = mysqli_query($con, $insert_like);

					if($insert_like){

						//get post owner

						$get_post = "SELECT * FROM posts WHERE post_id = '$id'";
						$run_post = mysqli_query($con, $get_post);
						$row_post = mysqli_fetch_array($run_post);

						$postowner_id = $row_post['user_id'];

						//notify
						$insert_notification = "INSERT INTO notifications (user_from_id, user_to_id, other_id, type, status, date) VALUES ('$user_id','$postowner_id', '$id', 'like', 'unread', NOW())";
						$run_insert1 = mysqli_query($con, $insert_notification);
					}
				}

				header("HTTP/1.0 204 No Content");
				#echo "<script>window.open('my_post.php?u5Nm=$user_name', '_self')</script>";
			
			break;

			case 'sEcReuT': //my posts page (in user_posts()!

				$get_likes = "SELECT * FROM likes WHERE user_id='$user_id' AND post_id='$id' LIMIT 1";
				$run_likes = mysqli_query($con, $get_likes);
				$match = mysqli_num_rows($run_likes);

				$row_likes = mysqli_fetch_array($run_likes);
				$like_id = $row_likes['id'];

				if($match>0){
					//like already exists (delete from the likes table)

					$delete = "DELETE FROM likes WHERE id = '$like_id'";
					$run_delete = mysqli_query($con, $delete);

				}
				else{
					//like inexistent (add to to likes table)

					$insert_like = "INSERT INTO likes (user_id, post_id) VALUES ($user_id, $id);";
					$run_insert = mysqli_query($con, $insert_like);

					if($insert_like){

						//get post owner

						$get_post = "SELECT * FROM posts WHERE post_id = '$id'";
						$run_post = mysqli_query($con, $get_post);
						$row_post = mysqli_fetch_array($run_post);

						$postowner_id = $row_post['user_id'];

						//notify
						$insert_notification = "INSERT INTO notifications (user_from_id, user_to_id, other_id, type, status, date) VALUES ('$user_id','$postowner_id', '$id', 'like', 'unread', NOW())";
						$run_insert1 = mysqli_query($con, $insert_notification);
					}
				}

				header("HTTP/1.0 204 No Content");

				#echo "<script>window.open('results.php?user_query=$search_query&search=', '_self')</script>";
			
			break;

			case 'usS09RtpHm': //my posts page (in user_posts()!

				$get_likes = "SELECT * FROM likes WHERE user_id='$user_id' AND post_id='$id' LIMIT 1";
				$run_likes = mysqli_query($con, $get_likes);
				$match = mysqli_num_rows($run_likes);

				$row_likes = mysqli_fetch_array($run_likes);
				$like_id = $row_likes['id'];

				if($match>0){
					//like already exists (delete from the likes table)

					$delete = "DELETE FROM likes WHERE id = '$like_id'";
					$run_delete = mysqli_query($con, $delete);

				}
				else{
					//like inexistent (add to to likes table)

					$insert_like = "INSERT INTO likes (user_id, post_id) VALUES ($user_id, $id);";
					$run_insert = mysqli_query($con, $insert_like);

					if($insert_like){

						//get post owner

						$get_post = "SELECT * FROM posts WHERE post_id = '$id'";
						$run_post = mysqli_query($con, $get_post);
						$row_post = mysqli_fetch_array($run_post);

						$postowner_id = $row_post['user_id'];

						//get postowner's username 

						$get_uname = "SELECT user_name FROM users WHERE user_id = '$postowner_id'";
						$run_uname = mysqli_query($con, $get_uname);
						$row_uname = mysqli_fetch_array($run_uname);
						$user_nom = $row_uname['user_name'];

						//notify
						$insert_notification = "INSERT INTO notifications (user_from_id, user_to_id, other_id, type, status, date) VALUES ('$user_id','$postowner_id', '$id', 'like', 'unread', NOW())";
						$run_insert1 = mysqli_query($con, $insert_notification);
					}
				}

				header("HTTP/1.0 204 No Content");
				#echo "<script>window.open('user_profile.php?u5Nm=$user_nom', '_self')</script>";
			
			break;

	}
}

 ?>