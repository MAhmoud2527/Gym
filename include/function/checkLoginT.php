<?php
// Check if user is Not Trainee

if (!isset($_SESSION['role']) == 'trainee') {
    header("Location: https://localhost/gym/login.php");
}
