<?php
// Check if user is Coach

if (!isset($_SESSION['role']) == 'coach') {
    header("Location: https://localhost/gym/login.php");
}
