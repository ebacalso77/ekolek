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

<body class="bg-gradient-success" >

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
                                    <a class="text-decoration-none text-dark" href="collector_main.php" ><i class="fa fa-arrow-left fa-lg"></i></a>
                                </div>
                                <div class="float-left ml-2">
                                    <img src="../img/recycle.png" alt=""  class="img-thumbnail mx-2" width="40" height="40">
                                </div>
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-3" style="font-size: 30px;font-weight: bolder;">E-Kolek</h1>
                                </div>
                                <div class="text-center my-3">
                                    <h4 class="text-gray-900 " style="font-weight: bolder;">Collection Report</h4>
                                    <span> <a href="completion_report_tbl.php" class="text-decoration-none"><i class="fa fa-eye"></i> Show report list</a></span>
                                </div>
                                <div class="table" style="font-size: small">
                                    <?php
                                    if (isset($_POST['collect'])){
                                        $id=$_POST['user_id'];
                                        $total=$_POST['total'];
                                        $brgy=$_POST['brgy'];
                                        $date_collection=$_POST['date_collection'];

                                        $insert=mysqli_query($con,"INSERT INTO `tbl_collection_completion_report` ( `ccr_user_id`, `ccr_total_truck`, `ccr_brgy`, `ccr_date_collection`, `ccr_date_reported`,ccr_status) VALUES ('$id', '$total', '$brgy', '$date_collection', current_timestamp(),'collected')");
                                        if ($insert===true){
                                            echo '<script>alert("Completion Report Submitted successfully.");window.open("completion_report.php","_self")</script>';
                                        }else{
                                            echo '<script>alert("Error while sending report.")</script>';
                                        }
                                    }
                                    ?>
                                    <div class="mt-3" id="collection">
                                        <form method="post"  style="font-size: 12px" class="mt-2"  enctype="multipart/form-data">
                                            <div class="form-group">
                                                <h6><span class="text-danger">*</span>Total Truck Collected</h6>
                                                <input type="number" class="form-control" name="total" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                                                <h6><span class="text-danger">*</span>Name of Baranggay</h6>
                                                <select name="brgy" id="" class="form-control" required>
                                                    <option value="">Select baranggay....</option>
                                                    <?php
                                                    $get_brgy=mysqli_query($con,"SELECT * FROM `baranggay` where m_id='".$_SESSION['user_m_id']."'");
                                                    if (mysqli_num_rows($get_brgy)>0){
                                                        while($r=mysqli_fetch_assoc($get_brgy)){
                                                            ?>
                                                            <option value="<?=$r['b_id']?>"><?=$r['b_name']?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <h6><span class="text-danger">*</span>Date of Collection</h6>
                                                <input type="date" class="form-control" name="date_collection" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block" name="collect">Submit</button>
                                        </form>
                                    </div>
                                </div>
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

