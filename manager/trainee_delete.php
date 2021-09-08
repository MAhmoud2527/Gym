<?php
require '../include/function/function.php';
// require '../include/function/checkLogin.php';
require '../include/function/checkLoginM.php';
require '../include/template/connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM `users` WHERE  id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$filename = '../uploads/trainee/';
$imageName = $data['photo'];
$finalPath = $filename . $imageName;
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
if (filter_var($id, FILTER_VALIDATE_INT)) {
    $sql = "DELETE FROM `users` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: trainee.php");
        unlink($finalPath); // Delete image from Folder
    }
}
