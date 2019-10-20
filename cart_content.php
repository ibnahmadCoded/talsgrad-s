<?php 

$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
#session_start();

global $con;

			if(isset($_GET['u5Nm'])){
				$u_name = $_GET['u5Nm'];

				$get_u_id = "SELECT * FROM users WHERE user_name = '$u_name'";
				$run_get_u_id = mysqli_query($con, $get_u_id);
				$row_u_id = mysqli_fetch_array($run_get_u_id);

				$u_id = $row_u_id['user_id'];
				$first_name = $row_u_id['f_name'];
				$last_name = $row_u_id['l_name'];

			}

echo "

<div class='col-sm-2' style='background-color: #e6e6e6; text-align: center; left: 0.8%; border-radius: 5px; margin: 20px;'> ";
			
			

			$get_cart = "SELECT * FROM cart WHERE user_id='$u_id'";
			$run_cart = mysqli_query($con, $get_cart);

			$number  = mysqli_num_rows($run_cart);

			echo "<center><h2><strong>CART</strong></h2></center>
				<center><h4><strong>Dear $first_name $last_name,</strong></h4></center>
				<strong><i style='font-size:9px;'>you have $number item(s) in your cart</i></strong><br>
				<strong><i style='font-size:10px;'>Please inquire before checking out</i></strong><br>
			";

			while ($row_cart = mysqli_fetch_array($run_cart)) {

				$post_id = $row_cart['post_id'];
				$owner_id = $row_cart['owner_id'];

				$get_post = "SELECT * FROM posts WHERE post_id='$post_id' AND user_id='$owner_id' LIMIT 2";
				$run_post = mysqli_query($con, $get_post);

				$row_post = mysqli_fetch_array($run_post);

				$upload_image = $row_post['upload_image'];
				$content = $row_post['post_content'];

				if($upload_image != ''){
					echo"

					<img class='img-circle' src='imagepost/$upload_image' width='50' height='50''>
					<strong><i style='font-size:7px;'>$content</i></strong><br><br>

					";
				}
				else{
					echo"

					<strong><i style='font-size:7px;'>$content</i></strong><br>

					";
				}
			}

			echo "<a href='cart.php?u5Nm=$u_name'><button class='btn btn-success' style='background-color:#232742'>View Cart</button></a><br>";

echo "
		</div>
";

 ?>