<?php

include("includes/connection.php");

    $key=$_GET['key'];
    $array = array();
    global $con; 
    $query=mysqli_query($con, "select * from users where title LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['f_name'];
    }
    echo json_encode($array);
?>
