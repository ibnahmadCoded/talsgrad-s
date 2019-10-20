<?php 

$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
#session_start();

if(isset($_GET['u5Nm'])){
				$u_name = $_GET['u5Nm'];

				$get_u_id = "SELECT * FROM users WHERE user_name = '$u_name'";
				$run_get_u_id = mysqli_query($con, $get_u_id);
				$row_u_id = mysqli_fetch_array($run_get_u_id);

				$u_id = $row_u_id['user_id'];
				

				$get_cart = "SELECT * FROM cart WHERE user_id='$u_id'";
				$run_cart = mysqli_query($con, $get_cart);

				$number  = mysqli_num_rows($run_cart);

			}

echo "
		<div class='col-sm-12' style='text-align: center; align-content: center;'> ";


			echo "<center><h2><strong>Your CART</strong></h2></center>
					<strong><i style='font-size:15px;'>you have $number item(s) in your cart</i></strong><br>
				<strong><i style='font-size:15px;'>Please inquire before checking out</i></strong><br><br><br>
			";

			while ($row_cart = mysqli_fetch_array($run_cart)) {

				$post_id = $row_cart['post_id'];
				$owner_id = $row_cart['owner_id'];
				$cart_id = $row_cart['cart_id'];

				$get_post = "SELECT * FROM posts WHERE post_id='$post_id' AND user_id='$owner_id' LIMIT 2";
				$run_post = mysqli_query($con, $get_post);

				$row_post = mysqli_fetch_array($run_post);

				$upload_image = $row_post['upload_image'];
				$content = $row_post['post_content'];

				if($upload_image != ''){
					echo"

					<div style= 'margin:30px'>

					<a href='functions/delete_cart.php?cart_id=$cart_id' style='margin-left:30px;'><button class='btn btn-danger' style='background-color:#232742;'>Remove</button></a>
					<img class='img-circle' src='imagepost/$upload_image' width='80' height='80''>
					<strong><i style='font-size:17px;'>$content</i></strong>
					
					</div>
					";
				}
				else{
					echo"
					<div style= 'margin:30px'>

					<a href='functions/delete_cart.php?cart_id=$cart_id' style='margin-left:30px;'><button class='btn btn-danger' style='background-color:#232742;'>Remove</button></a>
					<strong><i style='font-size:17px;'>$content</i></strong>
					
					</div>
					";
				}
			}

			if($number != 0){
				echo "
								<br><br>
			<a href='checkout.php?u5Nm=$u_name&items=$number'><button class='btn btn-success' style='background-color:#fd4720;'>Checkout</button></a><br>";
			}

echo "
		</div>
";

 ?>