<?php

require '../include/function/function.php';
// require '../include/function/checkLogin.php'; 
require '../include/function/checkLoginC.php';
require '../include/template/connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM `exercises` WHERE  id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$filename = '../uploads/exercises/';

$imageName = $data['exercises_photo'];
$finalPath = $filename . $imageName;

$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
if (filter_var($id, FILTER_VALIDATE_INT)) {
    $sql = "DELETE FROM `exercises` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: view.php");
        unlink($finalPath); // Delete image from Folder
    } else {
        echo mysqli_error($conn);
    }
}
