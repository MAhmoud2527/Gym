<?php
// Check if user is login

if (!isset($_SESSION['role'])  &&  !isset($_SESSION['userData'])) {
    header("Location: https://localhost/gym/login.php");
}
