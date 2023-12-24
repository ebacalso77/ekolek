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

    <title>Collector Main | E-Kolek</title>

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
                                    <img src="../img/collect.png" alt="" class="img-thumbnail">
                                </div>
                                    <div class="text-left mt-4">
                                        <?php
                                        if (isset($_POST['duty1'])){
                                           $update_duty= mysqli_query($con,"UPDATE `tbl_user` SET `duty` = '1' WHERE `tbl_user`.`user_id` = '".$_SESSION['user_id']."'");
                                            if ($update_duty===true){
                                                echo '<script>window.open("collector_main.php","_self");</script>';
                                            }
                                        }
                                        if (isset($_POST['duty2'])){
                                            $update_duty= mysqli_query($con,"UPDATE `tbl_user` SET `duty` = '0' WHERE `tbl_user`.`user_id` = '".$_SESSION['user_id']."'");
                                            if ($update_duty===true){
                                                echo '<script>window.open("collector_main.php","_self");</script>';
                                            }
                                        }
                                        ?>
                                        <form action="" method="post">
                                            <?php
                                            $select_user=mysqli_query($con,"select * from tbl_user where user_id='".$_SESSION['user_id']."'");
                                            if (mysqli_num_rows($select_user)>0){
                                                $user=mysqli_fetch_assoc($select_user);
                                                if ($user['duty']=="0"){
                                                    echo ' <button class="btn btn-outline-success btn-lg font-weight-bold text-dark" type="submit" name="duty1" style="border-radius: 10px; width: 100%;"> <i class="fa fa-truck fa-lg"></i> &nbsp;Start Pickup<span class="position-absolute top-0 start-100 translate-middle p-2 bg-secondary border border-light rounded-circle mx-2"></span></button>';
                                                }elseif ($user['duty']=="1"){
                                                    echo ' <button class="btn btn-outline-success btn-lg font-weight-bold text-dark" type="submit" name="duty2" style="border-radius: 10px; width: 100%;"> <i class="fa fa-shipping-fast fa-lg"></i> &nbsp;On Duty<span class="position-absolute top-0 start-100 translate-middle p-2 bg-success border border-light rounded-circle mx-2"></span></button>';
                                                }
                                            }
                                            ?>
                                        </form>
                                    </div>
                                <?php
                                if ($user['duty']=="0"){
                                    ?>
                                    <div class="text-left mt-4">
                                        <a  class="btn btn-outline-success btn-lg font-weight-bold text-dark disabled" style="border-radius: 10px; width: 100%;" > <i class="fa fa-chalkboard fa-lg"></i> &nbsp;Bulletin Board
                                            <?php
                                            $show= mysqli_query($con,"SELECT * FROM `tbl_bulletin_viewer` where v_user_id='".$_SESSION['user_id']."' and v_status='0'");
                                            if (mysqli_num_rows($show)>0){
                                                echo ' <span class="badge bg-danger text-light" style="border-radius: 50px">'.mysqli_num_rows($show).'</span>';
                                            }else{
                                                echo "";
                                            }
                                            ?>
                                        </a>
                                    </div>
                                <div class="text-left mt-4">
                                    <button type="button" class="btn btn-outline-success font-weight-bold text-dark btn-lg w-100" style="border-radius: 10px; width: 100%;" data-toggle="modal" data-target="#exampleModal" disabled>
                                        <i class="fa fa-paper-plane fa-lg"></i> Notify Residence
                                    </button>
                                </div>
                                    <div class="text-left mt-4">
                                        <a href="complaint_tbl.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark disabled" style="border-radius: 10px; width: 100%;"> <i class="fa fa-book fa-lg"></i> &nbsp;Complaint List</a>
                                    </div>
                                    <div class="text-left mt-4">
                                        <a href="request_tbl.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark disabled" style="border-radius: 10px; width: 100%;"> <i class="fa fa-eye fa-lg"></i> &nbsp;See Request
                                            <?php
                                            $request=mysqli_query($con," SELECT * FROM `tbl_request`");
                                            if (mysqli_num_rows($request)>0){
                                                $r=mysqli_fetch_assoc($request);
                                                if ($r['r_status']=="done"){
                                                    echo "";
                                                }else {
                                                    echo ' <span class="badge bg-secondary text-light mx-2">' . mysqli_num_rows($request) . '</span>';
                                                }
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <div class="text-left mt-4">
                                        <a href="complaint_tbl.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark disabled" style="border-radius: 10px; width: 100%;"> <i class="fa fa-file fa-lg"></i> &nbsp;Completion Report</a>
                                    </div>
                                    <div class="text-left mt-4">
                                        <a href="collection_ratings.php"  type="submit" class="btn btn-outline-success btn-lg font-weight-bold text-dark disabled" style="border-radius: 10px; width: 100%;" > <i class="fa fa-thumbs-up fa-lg"></i> &nbsp;Collection Ratings</a>
                                    </div>
                                    <div class="text-left mt-4">
                                        <form action="" method="post">
                                            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                                            <button  type="submit" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px; width: 100%;" name="update_notif" disabled> <i class="fa fa-bell fa-lg"></i> &nbsp;Notification
                                                <?php
                                                $show= mysqli_query($con,"select * from tbl_notification where user_id='".$_SESSION['user_id']."' and notif_view='0'");
                                                if (mysqli_num_rows($show)>0){
                                                    echo ' <span class="badge bg-danger text-light" style="border-radius: 50px">'.mysqli_num_rows($show).'</span>';
                                                }else{
                                                    echo "";
                                                }
                                                ?>
                                            </button>
                                        </form>
                                    </div>
                                <?php
                                }
                                elseif ($user['duty']=="1"){
                                    if(isset($_POST['notify'])){
                                        $user=$_POST['user'];
                                        $message=$_POST['message'];
                                        $brgy=$_POST['brgy'];
                                        $datepass=$_POST['datepass'];
                                        $timefrom=$_POST['timefrom'];
                                        $timeto=$_POST['timeto'];
                                        $fileTmp = "otw.jpg";
                                        $uploadPath = "../img/" . $fileTmp;

                                        $enc_mes=base64_encode($message);

                                        $SelectUserAccount=mysqli_query($con,"SELECT * FROM tbl_user where brgy='$brgy'or user_type='1' or user_type='3' ");
                                        if (mysqli_num_rows($SelectUserAccount)>0) {
                                            $insert=mysqli_query($con,"INSERT INTO `tbl_bulletin` ( `posted_by`, `b_message`, `b_photo`, `b_posted_date`,date_pass,b_brgy_id, time_to,time_from) VALUES ( '".$_SESSION['user_id']."', '$enc_mes', '$uploadPath', current_timestamp(), '$datepass','$brgy','$timeto','$timefrom')");
                                            $lastId=mysqli_insert_id($con);
                                            if ($insert === true) {
                                                move_uploaded_file($fileTmp, $uploadPath);
                                            }
                                            while ($sua = mysqli_fetch_assoc($SelectUserAccount)) {
                                                mysqli_query($con, "INSERT INTO `tbl_bulletin_viewer` ( `v_b_id`, `v_user_id`,v_status) VALUES ( '$lastId','".$sua['user_id']."','0')");
                                            }
                                            echo '<script>alert("Residents is Notified.");window.open("collector_main.php","_self")</script>';
                                        }else{
                                            echo '<script>alert("No resident has been registered in this baranggay .");window.open("collector_main.php","_self")</script>';
                                        }
                                    }
                                    ?>
                                    <div class="text-left mt-4">
                                        <?php
                                        if (isset($_POST['update'])){
                                            $id=$_POST['user_id'];
                                            $go=mysqli_query($con,"SELECT * FROM `tbl_bulletin_viewer` where v_user_id='$id' and v_status='0'");
                                            if (mysqli_num_rows($go)>0){
                                                $update=mysqli_query($con,"UPDATE `tbl_bulletin_viewer` SET `v_status` = '1' WHERE `v_user_id` = '$id'");
                                                if ($update===true){
                                                    echo '<script>window.open("bulletin_board.php","_self")</script>';
                                                }
                                            }else{
                                                echo '<script>
var result = confirm("No latest update. Do you want to continue?");

if (result) {
  window.open("bulletin_board.php","_self");
} else {
  window.open("collector_main.php","_self");
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
                                            <button type="button" class="btn btn-outline-success font-weight-bold text-dark btn-lg" style="border-radius: 10px; width: 100%;" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fa fa-paper-plane fa-lg"></i> Notify Residence
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title fs-5" id="exampleModalLabel">Notify Residence</h4>
                                                        </div>
                                                        <form action="" method="post">
                                                        <div class="modal-body">
                                                            <h5 class="text-center">Draft Message</h5>
                                                            <div class="card-body">
                                                                <input type="hidden" name="user" value="<?=$_SESSION['user_id']?>">
                                                                <label for="brgy">Select Barangay Schedule of Collection</label>
                                                                <select name="brgy" id="brgy" class="form-control" required>
                                                                    <option value="">Select barangay</option>
                                                                    <?php
                                                                    $get_brgy=mysqli_query($con,"select * from baranggay where m_id='".$_SESSION['user_m_id']."'");
                                                                    if (mysqli_num_rows($get_brgy)>0){
                                                                        while ($gb=mysqli_fetch_assoc($get_brgy)){
                                                                            ?>
                                                                            <option value="<?=$gb['b_id']?>"><?=$gb['b_name']?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <div class="my-1"></div>
                                                                <label for="">Select Date of Collection</label>
                                                                <input type="date" class="form-control" name="datepass" required>
                                                                <div class="my-1"></div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="">Select time from: </label>
                                                                        <input type="time" class="form-control" name="timefrom" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="">Select time to: </label>
                                                                        <input type="time" class="form-control" name="timeto" required>
                                                                    </div>
                                                                </div>
                                                                <div class="my-1"></div>
                                                                <label for="">Message (Tagalog/English)</label>
                                                                <textarea name="message" id="" class="form-control" cols="30" rows="5" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary btn-sm" name="notify">Submit</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="text-left mt-4">
                                        <a href="complaint_tbl.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px; width: 100%;"> <i class="fa fa-book fa-lg"></i> &nbsp;Complaint List</a>
                                    </div>
                                    <div class="text-left mt-4">
                                        <a href="request_tbl.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px; width: 100%;"> <i class="fa fa-eye fa-lg"></i> &nbsp;See Request
                                            <?php
                                            $request=mysqli_query($con," SELECT * FROM `tbl_request`");
                                            if (mysqli_num_rows($request)>0){
                                                $r=mysqli_fetch_assoc($request);
                                                if ($r['r_status']=="done"){
                                                    echo "";
                                                }else {
                                                    echo ' <span class="badge bg-danger text-light mx-2">' . mysqli_num_rows($request) . '</span>';
                                                }
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <div class="text-left mt-4">
                                        <a href="completion_report.php" class="btn btn-outline-success btn-lg font-weight-bold text-dark " style="border-radius: 10px; width: 100%;"> <i class="fa fa-file fa-lg"></i> &nbsp;Completion Report</a>
                                    </div>
                                    <?php
                                    if (isset($_POST['update_notif'])){
                                        $id=$_POST['user_id'];
                                        $go=mysqli_query($con,"SELECT * FROM `tbl_notification` where user_id='$id' and notif_view='0'");
                                        if (mysqli_num_rows($go)>0){
                                            $update=mysqli_query($con,"UPDATE `tbl_notification` SET `notif_view` = '1' WHERE `tbl_notification`.`user_id` = '$id'");
                                            if ($update===true){
                                                echo '<script>window.open("notification.php","_self")</script>';
                                            }
                                        }else{
                                            echo '<script>
var result = confirm("No latest update. Do you want to continue?");

if (result) {
  window.open("notification.php","_self");
} else {
  window.open("collector_main.php","_self");
}
</script>';
                                        }
                                    }
                                    ?>
                                    <div class="text-left mt-4">
                                        <a href="collection_ratings.php"  type="submit" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px; width: 100%;" > <i class="fa fa-thumbs-up fa-lg"></i> &nbsp;Collection Ratings</a>
                                    </div>
                                    <div class="text-left mt-4">
                                        <form action="" method="post">
                                            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                                            <button  type="submit" class="btn btn-outline-success btn-lg font-weight-bold text-dark" style="border-radius: 10px; width: 100%;" name="update_notif"> <i class="fa fa-bell fa-lg"></i> &nbsp;Notification
                                                <?php
                                                $show= mysqli_query($con,"select * from tbl_notification where user_id='".$_SESSION['user_id']."' and notif_view='0'");
                                                if (mysqli_num_rows($show)>0){
                                                    echo ' <span class="badge bg-danger text-light" style="border-radius: 50px">'.mysqli_num_rows($show).'</span>';
                                                }else{
                                                    echo "";
                                                }
                                                ?>
                                            </button>
                                        </form>
                                    </div>
                                <?php
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
