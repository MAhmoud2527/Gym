<?php
// Check if user is Not Admin

if (!isset($_SESSION['role']) == 'admin') {
    header("Location: https://localhost/gym/login.php");
}
