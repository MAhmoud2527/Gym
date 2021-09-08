<?php
ob_start();
$serverName = "localhost"; // Server Name
$userName = "root";       // User Name
$pass = "";              // Password
$dbName = "gym_db";     // DataBase Name

$conn = mysqli_connect($serverName, $userName, $pass, $dbName);
// check Connection 
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
