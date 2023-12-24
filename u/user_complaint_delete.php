<?php
session_start();
include "../connection.php";
$r=$_GET['r_id'];
$del=mysqli_query($con,"delete from tbl_report where report_id='$r'");
if ($del){
    echo '<script>alert("Complaint remove successful.");window.open("user_complaint_tbl.php","_self");</script>';
}else{
    echo '<script>alert("Error while deleting complaint.");window.open("user_complaint_tbl.php","_self");</script>';
}

