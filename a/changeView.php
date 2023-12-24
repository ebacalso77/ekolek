<?php
session_start();
include "../connection.php";
$report_id=$_GET['id'];

$select=mysqli_query($con,"select * from tbl_report where report_id='$report_id'");
if (mysqli_num_rows($select)>0){
    mysqli_query($con,"UPDATE `tbl_report` SET `View` = 'read', `status` = 'done' WHERE `tbl_report`.`report_id` = '$report_id'");
    echo '<script>alert("Status updated.");window.open("complaint.php","_self")</script>';
}
