<?php
session_start();
include "../connection.php";

$user=mysqli_query($con,"select * from tbl_user where user_id='".$_SESSION['user_id']."'");
if (mysqli_num_rows($user)>0){
    $u=mysqli_fetch_assoc($user);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Collector Completion | E-Kolek</title>

    <!-- Custom fonts for this template-->

    <link href=".././vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href=".././css/admin-2.min.css" rel="stylesheet">
    <link rel="icon" href=".././img/recycle.png">
    <script src="../a/script.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gradient-success">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-1">

        <div class="col-lg-6 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-3">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12" >
                            <br>
                            <div class="p-4">
                                <div class="float-right dragstart" style="font-size: 20px">
                                    <a href="" type="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-fw fa-cog"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#updatePass">Update Password</a></li>
                                        <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#updatePhoto">Change Photo</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </div>


                                <div class="text-left">
                                    <a class="text-decoration-none text-dark" href="completion_report.php" ><i class="fa fa-arrow-left fa-lg"></i></a>
                                </div>
                                <div class="float-left ml-2">
                                    <img src="../img/recycle.png" alt=""  class="img-thumbnail mx-2" width="40" height="40">
                                </div>
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-3" style="font-size: 30px;font-weight: bolder;">E-Kolek</h1>
                                </div>
                                <div class="text-center my-3">
                                    <h4 class="text-gray-900 " style="font-weight: bolder;">Waste Completion List</h4>
                                </div>
                                <div class="table" style="font-size: small">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Action</th>
                                            <th>Total Number of Truck</th>
                                            <th>Brgy Collected</th>
                                            <th>Date Collected</th>
                                            <th>Date Transferred</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($_POST['change'])){
                                            $r_id=$_POST['r_id'];
                                            $status=mysqli_query($con,"UPDATE `tbl_collection_completion_report` SET `ccr_status` = 'transferred',ccr_date_transferred=current_timestamp() WHERE `tbl_collection_completion_report`.`ccr_id` = '$r_id'");
                                            if($status==true){
                                                echo '<script>alert("Transmittal Status updated successful");window.open("completion_report_tbl.php","_self")</script>';
                                            }
                                        }
                                        if (isset($_POST['otw'])){
                                            $r_id=$_POST['r_id'];
                                            $status=mysqli_query($con,"UPDATE `tbl_collection_completion_report` SET `ccr_status` = 'on the way' WHERE `tbl_collection_completion_report`.`ccr_id` = '$r_id'");
                                            if($status==true){
                                                echo '<script>alert("Transmittal Status updated successful");window.open("completion_report_tbl.php","_self")</script>';
                                            }
                                        }
                                        $get_date_completion=mysqli_query($con,"SELECT * FROM `tbl_collection_completion_report` where ccr_user_id='".$_SESSION['user_id']."' order by ccr_id DESC");
                                        if (mysqli_num_rows($get_date_completion)>0){
                                            while ($com=mysqli_fetch_assoc($get_date_completion)){
                                                ?>
                                                <tr>
                                                    <td><?=$com['ccr_id']?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($com['ccr_status']=="transferred"){
                                                            echo '<span class="text-success text-center" style="font-size: 20px"><i class="fa fa-check-circle" ></i></span>';
                                                        }else{
                                                          ?>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="r_id" value="<?=$com['ccr_id']?>">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle btn-shadow"  style="border-radius: 15px" type="button" data-toggle="dropdown" aria-expanded="false">
                                                                        Update
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><button class="dropdown-item btn btn-sm "  style="border-radius: 15px" type="submit" name="otw">On the way</button></li>
                                                                        <li><button class="dropdown-item btn btn-sm "  style="border-radius: 15px" type="submit" name="change">Transferred</button></li>
                                                                    </ul>
                                                                </div>
                                                            </form>
                                                                <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?=$com['ccr_total_truck']?></td>
                                                    <td><?php
                                                        $sel_brgy=mysqli_query($con,"SELECT * FROM `baranggay` where m_id='".$_SESSION['user_m_id']."' ");
                                                        if (mysqli_num_rows($sel_brgy)>0) {
                                                            while ($b = mysqli_fetch_assoc($sel_brgy)) {
                                                                if ($com['ccr_brgy'] == $b['b_id']) {
                                                                    echo ucwords($b['b_name']);
                                                                }
                                                            }
                                                        }
                                                       ?></td>
                                                    <td><?=date("d M,Y",strtotime($com['ccr_date_collection']))?></td>
                                                   <td><?php
                                                       if($com['ccr_date_transferred']==NULL){
                                                           echo "";
                                                       }else {
                                                           echo date("d M,Y h:i:s ", strtotime($com['ccr_date_transferred']));
                                                       }
                                                       ?></td>
                                                    <td>
                                                        <?php
                                                        if ($com['ccr_status']=="collected" or $com['ccr_status']=="transferred"){
                                                            echo '<span class="badge badge-success">'.ucwords($com['ccr_status']).'</span>';
                                                        }elseif ($com['ccr_status']=="on-process"){
                                                            echo '<span class="badge badge-secondary">'.ucwords($com['ccr_status']).'</span>';
                                                        }elseif ($com['ccr_status']=="on the way"){
                                                            echo '<span class="badge badge-info">'.ucwords($com['ccr_status']).'</span>';
                                                        }
                                                        ?>
                                                        </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                       </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>

<!-- Bootstrap core JavaScript-->
<script src=".././vendor/jquery/jquery.min.js"></script>
<script src=".././vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src=".././vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src=".././js/sb-admin-2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            scrollY: 200,
            scrollX: true,
        });
    });
</script>

</body>

</html>
