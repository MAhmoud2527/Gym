<?php
// Check if user is Manager

if (!isset($_SESSION['role']) == 'manager') {
    header("Location: https://localhost/gym/login.php");
}
