<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "social_network";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>