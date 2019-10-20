<?php

include("includes/connection.php");
session_start();

global $con;

if(isset($_GET['type'], $_GET['id'])){

    $id = $_GET['id'];
    $type = $_GET['type'];


    $update ="UPDATE notifications SET status = 'read' WHERE id = '$id'";
    $run_update = mysqli_query($con, $update);

    $get_notification = "SELECT * FROM notifications WHERE id = '$id' ";

    $run_notification = mysqli_query($con, $get_notification);
    $row_notification = mysqli_fetch_array($run_notification);

    $user_id = $row_notification['user_from_id'];
    $userown_id = $row_notification['user_to_id'];
    $post_id = $row_notification['other_id'];
    #$user_to_id = $row_notifications['user_to_id'];
    #$type =  $row_notifications['type'];
    #$notification_status =  $row_notifications['status'];
    #$notification_date =  $row_notifications['date'];

    $get_uname = "SELECT user_name FROM users WHERE user_id = '$user_id'";
    $run_uname = mysqli_query($con, $get_uname);
    $row_uname = mysqli_fetch_array($run_uname);

    $user_name = $row_uname['user_name'];


    switch($type){ //make sure to send the required variables into notifications table in DB when inserting into the notifications table. post_id needs to be inserted into all types that are linked to a page that requires post id. 

                    case 'comment':
                         echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                        break;

                    case 'like':
                        echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                        break;

                    case 'inquire':

                        $update = "UPDATE user_messages SET msg_seen = 'yes' WHERE (user_to='$userown_id' AND user_from='$user_id') OR (user_from='$userown_id' AND user_to='$user_id')";
                        $run_update = mysqli_query($con, $update);
                        
                        if($run_update){
                            if($user_id == $userown_id){
                                echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                            }else{
                                echo "<script>window.open('messages.php?u5Nm=$user_name', '_self')</script>";
                            }
                        }
                        break;

                    case 'delpost':
                        echo "<script>window.open('notifications.php', '_self')</script>";
                        break;

                    case 'addbazaar':
                        echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                        break;

                    case 'rembazaar':
                        echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                        break;

                    case 'post':
                        echo "<script>window.open('user_profile.php?u5Nm=$user_name', '_self')</script>";
                        break;

                    case 'recommend':
                         echo "<script>window.open('user_profile.php?u5Nm=$user_name', '_self')</script>";
                        break;
                    case 'follow':
                         echo "<script>window.open('user_profile.php?u5Nm=$user_name', '_self')</script>";
                        break;
                    case 'unfollow':
                         echo "<script>window.open('user_profile.php?u5Nm=$user_name', '_self')</script>";
                        break;

                    case 'message':
                        echo "<script>window.open('messages.php?u5Nm=new', '_self')</script>"; //code should be ejected in the user messages page whereby if unseen messages count is >15, insertion is made in the notifications table. 
                        break;

                    case 'checkout':
                        echo "<script>window.open('single.php?post_id=$post_id', '_self')</script>";
                        #echo "<script>window.open('messages.php?u5Nm=$user_name', '_self')</script>";
                        break;

                    case 'welcome':
                        echo "<script>window.open('welcome.php', '_self')</script>";
                        break;

                    default:
                        echo "<script>window.open('notifications.php', '_self')</script>";
    }

}
    
?>