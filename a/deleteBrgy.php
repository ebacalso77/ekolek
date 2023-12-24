<?php
session_start();
include "../connection.php";
$b_id=$_GET['id'];
$select=mysqli_query($con,"Delete from baranggay where b_id='$b_id'");
if ($select){
    echo '<script>alert("Baranggay deleted Succesful.");window.open("collector.php?id=' . $_SESSION['user_id'] . '","_self");</script>';
}else{
    echo '<script>alert("Error encounter while removing baranggay.");window.open("collector.php?id=' . $_SESSION['user_id'] . '","_self");</script>';
}