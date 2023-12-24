<?php
include "../connection.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Main | E-Kolek</title>

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
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                                <div class="float-left ml-2">
                                    <img src="../img/recycle.png" alt=""  class="img-thumbnail mx-2" width="40" height="40">
                                </div>
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-3" style="font-size: 30px;font-weight: bolder;">E-Kolek</h1>
                                </div>
                                <div class="text-center">
                                    <img src="../img/user.png" alt="" class="img-thumbnail" >
                                </div>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["collected"])) {
                                    if (isset($_POST["satisfaction"])) {
                                        $selectedSatisfaction = htmlspecialchars($_POST["satisfaction"]);
                                        $user_id=$_SESSION['user_id'];
                                        $brgy=$_SESSION['brgy'];
                                        $sitio = $_POST['sitio'];

                                        $save=mysqli_query($con,"INSERT INTO `tbl_collection_ratings` ( `user_id`, cr_sitio,`brgy`, `cr_timestamp`,status, `ratings`) VALUES ( '$user_id','$sitio', '$brgy', current_timestamp(),'collected', '$selectedSatisfaction')");
                                        if ($save){
                                            echo '<script>alert("Thank for your feedback, Have a nice day!")</script>';
                                        }
                                    } else {
                                        echo '<script>alert("Please select a satisfaction level.")</script>';
                                    }
                                }
                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["notcollected"])) {
                                    if (isset($_POST["satisfaction"])) {
                                        $selectedSatisfaction = htmlspecialchars($_POST["satisfaction"]);
                                        $user_id=$_SESSION['user_id'];
                                        $brgy=$_SESSION['brgy'];
                                        $sitio = $_POST['sitio'];

                                        $save=mysqli_query($con,"INSERT INTO `tbl_collection_ratings` ( `user_id`, cr_sitio,`brgy`, `cr_timestamp`,status, `ratings`) VALUES ( '$user_id','$sitio', '$brgy', current_timestamp(),'not-collected', '$selectedSatisfaction')");
                                        if ($save){
                                            echo '<script>alert("Thank for your feedback, Have a nice day!")</script>';
                                        }
                                    } else {
                                        echo '<script>alert("Please select a satisfaction level.")</script>';
                                    }
                                }
                                ?>
                                <div class="row">
                                    <!-- Modal -->
                                    <div class="modal fade" id="collected" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title fs-5 text-center font-weight-bold" id="exampleModalLabel">Collected</h6>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="text-center">Hows our service?</h4>
                                                    <h6 class="text-center">Your feedback is important to us. Please select...</h6>
                                                    <form action="" method="post" class="mx-lg-5">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault1" value="1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                1 - Not at all satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault2" value="2">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                2 - Slightly satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault3" value="3">
                                                            <label class="form-check-label" for="flexRadioDefault3">
                                                                3 - Moderately satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault4" value="4">
                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                4 - Very satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault5" value="5">
                                                            <label class="form-check-label" for="flexRadioDefault5">
                                                                5 - Extremely satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-group my-2">
                                                            <h6><span class="text-danger mx-1">*</span>Sitio / Street</h6>
                                                            <input type="text" name="sitio" placeholder="Enter Sitio or Street name ....." class="form-control" required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-sm" name="collected">Submit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left mt-4 col-6">
                                        <a href=""  data-toggle="modal" data-target="#collected" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px;width: 100%;"><i class="fa fa-thumbs-up fa-lg"></i> &nbsp; Collected</a>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="notcollected" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title fs-5 text-center font-weight-bold" id="exampleModalLabel">Not Collected</h6>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="text-center">Hows our service?</h4>
                                                    <h6 class="text-center">Your feedback is important to us. Please select...</h6>
                                                    <form action="" method="post" class="mx-lg-5">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault1" value="1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                1 - Not at all satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault2" value="2">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                2 - Slightly satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault3" value="3">
                                                            <label class="form-check-label" for="flexRadioDefault3">
                                                                3 - Moderately satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault4" value="4">
                                                            <label class="form-check-label" for="flexRadioDefault4">
                                                                4 - Very satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="satisfaction" id="flexRadioDefault5" value="5">
                                                            <label class="form-check-label" for="flexRadioDefault5">
                                                                5 - Extremely satisfied
                                                            </label>
                                                        </div>
                                                        <div class="form-group my-2">
                                                            <h6><span class="text-danger mx-1">*</span>Sitio / Street</h6>
                                                            <input type="text" name="sitio" placeholder="Enter Sitio or Street name ....." class="form-control" required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary btn-sm" name="notcollected">Submit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left mt-4 col-6">
                                        <a href="" data-toggle="modal" data-target="#notcollected" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px;width: 100%;"><i class="fa fa-thumbs-down fa-lg"></i> &nbsp; Not Collected</a>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title fs-5 text-center" id="exampleModalLabel">Citizens Charter</h6>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $citizen=mysqli_query($con,"SELECT * FROM `tblcitizencharter`");
                                                if (mysqli_num_rows($citizen)>0){
                                                    $c=mysqli_fetch_assoc($citizen);
                                                }
                                                ?>
                                                <h4 class="text-center"><?=strtoupper($c['cc_lgu'])?></h4>
                                                <h6 class="text-center"><?=ucfirst($c['cc_lgu_office'])?></h6>
                                                <div class="table" style="font-size: small">
                                                    <table class="display table table-hover table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Frontline Service</th>
                                                            <th>Procedures</th>
                                                            <th>Time</th>
                                                            <th>Responsible Person</th>
                                                            <th>Requirements</th>
                                                            <th>Output</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $charter=mysqli_query($con,"SELECT * FROM `tblcitizencharter`");
                                                        if (mysqli_num_rows($charter)>0){
                                                            $i=0;
                                                            while ($c=mysqli_fetch_assoc($charter)){
                                                                ?>
                                                                <tr>
                                                                    <td><?=ucfirst($c['frontline_service'])?></td>
                                                                    <td><?=ucfirst($c['cc_procedure'])?></td>
                                                                    <td><?=ucfirst($c['time'])?></td>
                                                                    <td><?=ucfirst($c['responsible_person'])?></td>
                                                                    <td><?=ucfirst($c['requirements'])?></td>
                                                                    <td><?=ucfirst($c['output'])?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left mt-4">
                                    <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px;width: 100%;"><i class="fa fa-bookmark fa-lg"></i> &nbsp; Citizens Charter</a>
                                </div>
                                <div class="text-left mt-4">
                                    <?php
                                    if (isset($_POST['update'])){
                                        $id=$_POST['user_id'];
                                        $go=mysqli_query($con,"SELECT * FROM `tbl_bulletin_viewer` where v_user_id='$id' and v_status='0'");
                                        if (mysqli_num_rows($go)>0){
                                            $update=mysqli_query($con,"UPDATE `tbl_bulletin_viewer` SET `v_status` = '1' WHERE v_user_id = '$id'");
                                            if ($update===true){
                                                echo '<script>window.open("bulletin_board.php","_self")</script>';
                                            }
                                        }else{
                                            echo '<script>
var result = confirm("No latest update. Do you want to continue?");

if (result) {
  window.open("bulletin_board.php","_self");
} else {
  window.open("user_main.php","_self");
}
</script>';
                                        }
                                    }
                                    ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                                        <button  type="submit" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px; width: 100%;" name="update"> <i class="fa fa-chalkboard fa-lg"></i> &nbsp;Bulletin Board
                                            <?php
                                            $show= mysqli_query($con,"SELECT * FROM `tbl_bulletin_viewer` where v_user_id='".$_SESSION['user_id']."' and v_status='0'");
                                            if (mysqli_num_rows($show)>0){
                                                echo ' <span class="badge bg-danger text-light" style="border-radius: 50px">'.mysqli_num_rows($show).'</span>';
                                            }else{
                                                echo "";
                                            }
                                            ?>
                                        </button>
                                    </form>
                                </div>
                                <div class="text-left mt-4">
                                    <a href="user_complaint.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px;width: 100%;"><i class="fa fa-pen fa-lg"></i> &nbsp; Write a Complaint</a>
                                </div>
                                <div class="text-left mt-4">
                                    <a href="user_request.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px; width: 100%;"> <i class="fa fa-book-open fa-lg"></i> &nbsp;Write a Request</a>
                                </div>
                                <?php
                                $check_form=mysqli_query($con,"SELECT * FROM `form_stats` where s_id='1'");
                                if (mysqli_num_rows($check_form)>0){
                                    $c=mysqli_fetch_assoc($check_form);
                                    if ($c['status']=="1"){
                                        ?>
                                        <div class="text-left mt-4">
                                            <a href="weekly_satisfaction_review.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px; width: 100%;"> <i class="fa fa-eye fa-lg"></i> &nbsp;Weekly Satisfaction Review</a>
                                        </div>
                                <?php
                                    }else{
                                        ?>
                                        <div class="text-left mt-4">
                                            <a href="weekly_satisfaction_review.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark disabled" style="border-radius: 10px; width: 100%;"> <i class="fa fa-eye fa-lg"></i> &nbsp;Weekly Satisfaction Review</a>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <br>
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
