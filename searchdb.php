<?php  
 $connect = mysqli_connect("localhost", "root", "", "social_network");  
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM users WHERE f_name LIKE '%".$_POST["query"]."%' OR l_name LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '<ul id = "userslist" class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  

                $user_image = $row['user_image']; 
                $user_id = $row['user_id'];
                $output .= '<li id= "listedresult">'."<img src='users/$user_image' alt='Profile' class='img-circle' width='30px' height='30px' style='margin-right:10px;'>".$row["f_name"].' '.$row['l_name'].' '."<a style='visibility:hidden;font-size:1pxx;'>iahgshdjfjd=".$row['user_id'].'</a>'.'</li>'; 
           }  
      }  
      else  
      {  
           $output .= '<li>Person Not Found</li>';  
      }  

      $output .= '</ul>'; 

      echo $output; 
 }  
 ?>  
