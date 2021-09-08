<?php

require '../include/function/function.php';
require '../include/function/checkLogin.php';
require '../include/function/checkLoginA.php';
require '../include/template/connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM `users` WHERE  id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$filename = '../uploads/manager/';
$imageName = $data['photo'];
$finalPath = $filename . $imageName;
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
if (filter_var($id, FILTER_VALIDATE_INT)) {
    $sql = "DELETE FROM `users` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: member.php");
        unlink($finalPath); // Delete image from Folder
    }
}
