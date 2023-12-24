<?php
include "../connection.php";
if (isset($_POST['bulletin'])){
    $id=$_POST['user_id'];
    $go=mysqli_query($con,"SELECT * FROM `tbl_bulletin_viewer` where v_user_id='$id' and v_status='0'");
    if (mysqli_num_rows($go)>0){
        $update=mysqli_query($con,"UPDATE `tbl_bulletin_viewer` SET `v_status` = '1' WHERE `tbl_bulletin_viewer`.`v_user_id` = '$id'");
        if ($update===true){
            echo '<script>window.open("bulletin.php","_self")</script>';
        }
    }else{
        echo '<script>
var result = confirm("No latest update. Do you want to continue?");

if (result) {
  window.open("bulletin.php","_self");
} else {
 
}
</script>';
    }
}
if (isset($_POST['notif'])){
    $id=$_POST['user_id'];
    $go=mysqli_query($con,"SELECT * FROM `tbl_notification` where notif_view_admin='0'");
    if (mysqli_num_rows($go)>0){
        $update=mysqli_query($con,"UPDATE `tbl_notification` SET `notif_view_admin` = '1' ");
        if ($update===true){
            echo '<script>window.open("notification.php","_self")</script>';
        }
    }else{
        echo '<script>
var result = confirm("No latest update. Do you want to continue?");

if (result) {
  window.open("notification.php","_self");
} else {
 
}
</script>';
    }
}
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion " id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-recycle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Citizen Charter -->
    <li class="nav-item">
        <a class="nav-link " href="charter.php" >
            <i class="fas fa-fw fa-file"></i>
            <span>Citizen Charter</span>
        </a>
    </li>
    <!-- Nav Item - collector -->
    <li class="nav-item">
        <a class="nav-link " href="collector.php" >
            <i class="fas fa-fw fa-truck"></i>
            <span>Collector</span>
        </a>
    </li>

    <!-- Nav Item -complaint -->
    <li class="nav-item">
        <a class="nav-link " href="complaint.php">
            <i class="fas fa-fw fa-chart-pie"></i>
            <span>Complaint</span>
        </a>
    </li>
    <!-- Nav Item -report -->
    <li class="nav-item">
        <a class="nav-link " href="request.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Request</span>
        </a>
    </li>

    <!-- Nav Item -bulletin -->
    <li class="nav-item" >
        <form action="" method="post">
            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
        <button class="nav-link bg-transparent border-0" type="submit" name="bulletin">
            <i class="fas fa-fw fa-chalkboard"></i>
            <span>Bulletin Board</span>
            <?php
            $check= mysqli_query($con,"SELECT * FROM `tbl_bulletin_viewer` where v_user_id='".$_SESSION['user_id']."' and v_status='0'");
            if (mysqli_num_rows($check)>0){
                echo ' <span class="badge bg-danger mx-3 ">'.mysqli_num_rows($check).'</span>';
            }else{
                echo "";
            }
            ?>
        </button>
        </form>
    </li>
    <!-- Nav Item - Completion -->
    <li class="nav-item">
        <a class="nav-link" href="completion.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Completion</span></a>
    </li>
    <!-- Nav Item - Weekly Satisfaction Review -->
    <li class="nav-item">
        <a class="nav-link" href="weekly_satisfaction.php">
            <i class="fas fa-envelope-open"></i>
            <span>Weekly Satisfaction Review</span></a>
    </li>
    <!-- Nav Item - Users -->
    <li class="nav-item">
        <a class="nav-link" href="user.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span></a>
    </li>

<!--    Nav Item - Analytics-->
<!--    <li class="nav-item">-->
<!--        <a class="nav-link" href="analytics.php">-->
<!--            <i class="fas fa-fw fa-chart-bar"></i>-->
<!--            <span>Analytics</span></a>-->
<!--    </li>-->

    <!-- Nav Item - Settings-->
    <li class="nav-item">
        <a class="nav-link" href="profile.php">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Account Setting</span></a>
    </li>
    <li class="nav-item">
        <form action="" method="post">
            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
            <button class="nav-link bg-transparent border-0" type="submit" name="notif">
            <i class="fas fa-fw fa-bell"></i>
            <span>Notification</span>
            <?php
            $show= mysqli_query($con,"select * from tbl_notification where notif_view_admin='0'");
            if (mysqli_num_rows($show)>0){
                echo ' <span class="badge bg-danger text-light" style="border-radius: 50px">'.mysqli_num_rows($show).'</span>';
            }else{
                echo "";
            }
            ?>
        </button>
        </form>
    </li>
    <!-- Nav Item - logout-->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class=" fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

</ul>
<!-- End of Sidebar -->