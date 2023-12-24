<?php
session_start();
include "../connection.php";

$report_id=$_GET['id'];
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
                                    <a class="text-decoration-none text-dark" href="user_complaint_tbl.php" title="Complaint Table"><i class="fa fa-arrow-left fa-lg"></i></a>
                                </div>
                                <div class="float-left ml-2">
                                    <img src="../img/recycle.png" alt=""  class="img-thumbnail mx-2" width="40" height="40">
                                </div>
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-3" style="font-size: 30px;font-weight: bolder;">E-Kolek</h1>
                                </div>
                                <div class="text-center">
                                    <h2 class="h4 text-gray-900 mb-3" style="font-weight: bolder;">Satisfaction Ratings</h2>
                                </div>

                                <form action="" method="post" >
                                    <input type="hidden" name="rated_id" value="<?=$_SESSION['user_id']?>">
                                    <div class="form-group mt-4">
                                        <h6 for="comment"><span class="text-danger">*</span> Report Id</h6>
                                        <input type="text" readonly name="r_id" value='<?=$report_id?>' class="form-control">
                                    </div>
                                    <div class="form-group mt-4">
                                        <h6 for="comment"><span class="text-danger">*</span> Comment/Feedback</h6><textarea class="form-control" name="feedback" id="comment" cols="70" rows="4" required></textarea>
                                    </div>
                                    <h6 class="text-dark mt-2"><span class="text-danger">*</span>Slide to rate: <span id="rangeValueDisplay" class="text-dark">100</span>%</h6>
                                    <input type="range" id="rangeInput" class="form-control mb-2 container " name="rangeValue" min="0" max="100" step="1" value="100" required placeholder="Slide to rate.">
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
                                       <button type="submit" class="btn btn-primary w-100" name="send_feedback">Submit</button>
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
<?php
if (isset($_POST['send_feedback'])){
    $rater=$_POST['rated_id'];
    $r_id=$_POST['r_id'];
    $range=$_POST['rangeValue'];
    $feedback=$_POST['feedback'];
    $mes=base64_encode($feedback);
        $insert_feedback=mysqli_query($con,"INSERT INTO `tbl_report_feedback` ( `rf_rate`, `rf_feedback`, `rf_report_id`) VALUES ( '$range', '$mes', '$r_id')");
    if ($insert_feedback===true){
        mysqli_query($con,"UPDATE `tbl_report` SET `status` = 'rated' WHERE `tbl_report`.`report_id` = '$r_id'");
        mysqli_query($con,"INSERT INTO `tbl_report_status` (`s_status`, `s_report_id`, `s_date_updated`) VALUES ( 'rated', '$r_id', current_timestamp())");
        echo '<script>alert("Rate is being saved.");window.open("user_complaint_tbl.php","_self")</script>';
    }else{
        echo '<script>alert("Error while saving rate.");</script>';
    }
}
?>