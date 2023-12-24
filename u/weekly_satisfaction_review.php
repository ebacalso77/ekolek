<?php
session_start();
include "../connection.php";

$user=mysqli_query($con,"select * from tbl_user where user_id='".$_SESSION['user_id']."'");
if (mysqli_num_rows($user)>0){
    $u=mysqli_fetch_assoc($user);
}

if (isset($_POST['update'])){
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $phone=$_POST['phone'];
    $municipality=$_POST['municipality'];
    $brgay=$_POST['baranggay'];

   $up=mysqli_query($con,"UPDATE `tbl_user` SET `username` = '$username', `email` = '$email', `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `phone` = '$phone',user_m_id='$municipality',brgy='$brgay' WHERE `tbl_user`.`user_id` = '".$_SESSION['user_id']."'");
   if ($up){
       echo '<script>alert("Data Updated successful.");window.open("profile.php","_self");</script>';
   }
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

    <title>User Report | E-Kolek</title>

    <!-- Custom fonts for this template-->

    <link href=".././vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href=".././css/admin-2.min.css" rel="stylesheet">
    <link rel="icon" href=".././img/recycle.png">
    <script src="../a/script.js"></script>
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
                                    <a class="text-decoration-none text-dark" href="user_main.php" title="Main Menu"><i class="fa fa-arrow-left fa-lg"></i></a>
                                </div>
                                <div class="float-left ml-2">
                                    <img src="../img/recycle.png" alt=""  class="img-thumbnail mx-2" width="40" height="40">
                                </div>
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-3" style="font-size: 30px;font-weight: bolder;">E-Kolek</h1>
                                </div>
                                <div class="text-center">
                                    <h2 class="h4 text-gray-900 mb-3" style="font-weight: bolder;">Weekly Satisfaction Review</h2>
                                </div>
                                <?php
                                if (isset($_POST['rate_collector'])){
                                    $col_id=$_POST['person'];
                                    $rangeValue=$_POST['rangeValue'];
                                    $rated_id=$_POST['rated_id'];
                                    $insert_val=mysqli_query($con,"INSERT INTO `tbl_collector_satisfactory_rating` (`rated_by`, `collectors_id`, `ratings_no`, `date_rated`) VALUES ( '$rated_id', '$col_id', '$rangeValue', current_timestamp())");
                                    if ($insert_val===true){
                                        echo '<script>alert("Successfully save your satisfactory review.");</script>';
                                    }
                                }
                                ?>
                                <form action="" method="post" >
                                    <input type="hidden" name="rated_id" value="<?=$_SESSION['user_id']?>">
                                    <div class="form-group">
                                        <h6 class="text-dark"><span class="text-danger">*</span>Rate the following Collectors</h6>
                                    </div>
                                    <select name="person" required class="form-control">
                                        <option value="">Select collectors name...</option>
                                    <?php
                                    $get_collector=mysqli_query($con,"SELECT * FROM `tbl_user` where tbl_user.user_type='3' ");
                                    if (mysqli_num_rows($get_collector)>0){
                                        while ($col=mysqli_fetch_assoc($get_collector)){
                                            ?>
                                            <option value="<?=$col['user_id']?>"><?=ucwords($col['fname']." ".$col['mname']." ".$col['lname'])?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </select>
                                    <h6 class="text-dark mt-2"><span class="text-danger">*</span>Slide to rate: <span id="rangeValueDisplay" class="text-dark">100</span>%</h6>
                                    <input type="range" id="rangeInput" class="form-control mb-2 container w-75" name="rangeValue" min="0" max="100" step="1" value="100" required placeholder="Slide to rate.">
                                    <script>
                                        // Get references to the range input and the value display span
                                        const rangeInput = document.getElementById('rangeInput');
                                        const rangeValueDisplay = document.getElementById('rangeValueDisplay');

                                        // Update the value display span as the range input changes
                                        rangeInput.addEventListener('input', () => {
                                            rangeValueDisplay.textContent = rangeInput.value;
                                        });
                                    </script>
                                    <div class="text-center ">
                                       <button type="submit" class="btn btn-primary w-100" name="rate_collector">Submit</button>
                                    </div>
                                </form>
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

</body>

</html>
