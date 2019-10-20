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
	<title><?php echo "$user_fname $user_lname's notifications"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>


<center><h1>Your Notifications</h1></center>
<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div style="padding: 40px 50px; text-align: center;" class='col-sm-6'>
						 <div>
               <?php 

               	$get_notifications1 = "SELECT * from notifications where user_to_id = '$user_id' order by id DESC"; //get all notifications fo viewing
                $run_notifications1 = mysqli_query($con, $get_notifications1);

				$notification_num_rows1 = mysqli_num_rows($run_notifications1);

				if($notification_num_rows1 > 0){

					foreach ($run_notifications1 as $n){

					?>
						<a style ="
                         <?php
                            if($n['status']=='unread'){
                                echo "font-weight:bold; color: #fd4720;";
                            }else{
                                echo "color: #fd4720;";
                            }
                         ?>
                         " class="list-item" href="view_notification.php?type=<?php echo $n['type'] ?>&id=<?php echo $n['id'] ?>">
                 <small><i><?php echo date('F j, Y, g:i a',strtotime($n['date'])) ?></i></small><br/>
                 <?php

                 $user_from_id = $n['user_from_id'];
                 $type = $n['type'];

                 $get_user_from = "SELECT * from users where user_id = '$user_from_id'";
                 $run_get_user_from = mysqli_query($con, $get_user_from);
                 $row_user_from = mysqli_fetch_array($run_get_user_from);

                 $user_fname = $row_user_from['f_name'];
                 $user_lname = $row_user_from['l_name'];
                 $user_img = $row_user_from['user_image'];

                 switch($n['type']){

                    case 'comment':

                        if($user_id != $user_from_id){
                         echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> $user_fname $user_lname commented on your portfolio item.";
                        }else{
                            echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You commented on your portfolio item.";
                        }
                        break;

                    case 'like':

                        if($user_id != $user_from_id){
                            echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> $user_fname $user_lname liked your portfolio item.";
                        }else{
                            echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You liked your portfolio item.";
                        }
                        break;

                    case 'inquire':
                        if($user_id != $user_from_id){
                            echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> $user_fname $user_lname made an inquiry about your item.";
                        }else{
                            echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You made an inquiry about an item. The item's owner should reply soon.";
                        }
                        break;

                    case 'delpost':
                        echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You deleted your portfolio item.";
                        break;

                    case 'addbazaar':
                        echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You listed your portfolio item on bazaar.";
                        break;

                    case 'rembazaar':
                        echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You removed your portfolio item from bazaar.";
                        break;

                    case 'post':
                        echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You added a new portfolio item!";
                        break;

                    case 'recommend':

                        if($user_id != $user_from_id){
                         echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> $user_fname $user_lname recommended you to somebody.";
                        }else{
                            echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You recommended yourself to somebody.";
                        }
                        break;

                    case 'follow':
                         echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> $user_fname $user_lname started scouting you.";
                        break;

                    case 'unfollow':
                         echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> $user_fname $user_lname stopped scouting you.";
                        break;

                    case 'checkout':

                        if($user_id != $user_from_id){
                            echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> Your item was checked out from bazaar.Please check your inbox to complete the sales! Thank you";
                        }else{
                            echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You checked out an item from bazaar.The item owner will contact you soon! Thank you";
                        }
                        break;

                    case 'welcome':
                        echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> Welcome To Talsgrad! find out More...";
                        break;

                    case 'message':
                        echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> You have more than 15 unread messages."; //code should be ejected in the user messages page whereby if unseen messages count is >15, insertion is made in the notifications table. 
                        break;

                    default:
                        echo "<img class='img-circle' src='users/$user_img' width='30' height='30'> $user_fname $user_lname made a $type.";
                 }
                  
                  ?>
                </a>
                <div role='separator' class='divider'></div>
                <?php 
                	 }
                 }else{
                     echo "You have no notifications.";
                 }

                 ?>
           </div>

					</div>
					<div class='col-sm-3'>
					</div>
	</div><br><br>
</body>
</html>
