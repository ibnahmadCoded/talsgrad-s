<?php
include("includes/connection.php");
session_start(); // Must start session first thing 

if(isset($_GET['u5Nm'])){
	$user_name = $_GET['u5Nm'];
}

$get_activity = "SELECT last_activity FROM users WHERE user_name='$user_name'";
$sql = mysqli_query($con, $get_activity); 

while($row = mysqli_fetch_array($sql)){

	date_default_timezone_set('Africa/Lagos');

	$lastactivity = $row["last_activity"];

	$output1 = date("d - M - Y", strtotime($lastactivity));
	$output2 = date("H:i", strtotime($lastactivity));

	$last_activity = date('Y-m-d H:i:s', strtotime('+30 seconds', strtotime($lastactivity))); //when user, doesn't do anything on the site for 30s, it echoes last seen: $lastactivity!

	$current_time = date("Y-m-d H:i:s");



	if($current_time > $last_activity /*10 is the number of seconds user stay online without doing activity on the page you can always change it */){$onlineStats = "last seen: $output1, at $output2";}//if the last time you did something on your page + 10 seconds is less than the current time. your onlinestats will equal away or you can change to offline
	else{$onlineStats = "<i style='color:green;'> online </i> <p class='glyphicon glyphicon-signal' style='color:green;'></p>";}//if the last time you did something on your page + 10 seconds is greater than the current time. your onlinestats will equal online
	}
?>
<?php print"$onlineStats";?>