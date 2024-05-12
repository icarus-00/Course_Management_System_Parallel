<?php
ob_start();
session_start();
if(isset($_SESSION['ID'])){
$tutor_id =$_SESSION['ID'];
}else{
$tutor_id = '';
header('location:login.php');
}
include 'init.php';
if(isset($_GET['course_id'])&& isset($_GET['do'])){
$course_id = $_GET['course_id'];
$do=$_GET['do'];
if($do=="Delete"){
    $delete_playlist = $con->prepare("DELETE FROM `playlist` WHERE id = ?");
    $delete_playlist->execute([$course_id]);
    $delete_playlist = $con->prepare("DELETE FROM `content` WHERE playlist_id = ?");
    $delete_playlist->execute([$course_id]);
    header('location:course.php');
    }elseif ($do=="update"){
    echo "bro";
}
}else{
header('location:course.php');
}

