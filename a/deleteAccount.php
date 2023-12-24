<?php
session_start();
include "../connection.php";
$user_id=$_GET['id'];
$select=mysqli_query($con,"Delete from tbl_user where user_id='$user_id'");
if ($select){
    echo '<script>alert("Account Deleted Succesful.");window.open("collector.php?id=' . $_SESSION['user_id'] . '","_self");</script>';
}else{
    echo '<script>alert("Error encounter while removing account.");window.open("collector.php?id=' . $_SESSION['user_id'] . '","_self");</script>';
}