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
                                    <h2 class="h4 text-gray-900 mb-3" style="font-weight: bolder;">Complaint entry form</h2>
                                    <span>Write something about your complaint...</span><br>
                                    <a href="user_complaint_tbl.php" class="text-decoration-none">View Complaint list</a>
                                </div>
                                <br>
                                <?php
                                if (isset($_POST['send_report'])) {
                                    $complaint = $_POST['complaint'];
                                    $message = $_POST['report_m'];
                                    $brgy =$_POST['brgy'];
                                    $sitio =$_POST['sitio'];
                                    $fileCount = count($_FILES['file']['name']);

                                    if ($complaint !="2"){
                                        $insert_report = mysqli_query($con, "INSERT INTO `tbl_report` (`report_user_id`,r_brgy,r_sitio, `message`, `status`, `date_reported`, `report_m_id`, `report_b_id`) VALUES ( '" . $_SESSION['user_id'] . "','$brgy','$sitio', '$complaint', 'pending', current_timestamp(), '" . $_SESSION['user_m_id'] . "', '" . $_SESSION['brgy'] . "')");
                                        if ($insert_report) {
                                            $last_id = mysqli_insert_id($con);
                                            mysqli_query($con,"INSERT INTO `tbl_report_status` (`s_status`, `s_report_id`, `s_date_updated`) VALUES ( 'pending', '$last_id', current_timestamp())");
                                            if ($fileCount>3){
                                                echo '<script>alert("Maximum of 3 photo only.");</script>';
                                            }else{
                                                for ($i = 0; $i < $fileCount; $i++) {
                                                    $filename = $_FILES['file']['name'][$i];
                                                    $uploadPath = '../upload/' . $filename;
                                                    mysqli_query($con, "INSERT INTO `tbl_report_image` (`img_name`, `img_path`, `img_report_id`) VALUES ( '$filename', '$uploadPath', '$last_id')");

                                                    move_uploaded_file($_FILES['file']['tmp_name'][$i], '../upload/' . $filename);
                                                    echo '<script>alert("Complaint sent.");window.open("user_complaint_tbl.php","_self");</script>';
                                                }
                                            }
                                        }
                                    } elseif ($complaint == "2"){
                                        $com="Others -".$message;
                                        $insert_report = mysqli_query($con, "INSERT INTO `tbl_report` (`report_user_id`, r_brgy,r_sitio,`message`, `status`, `date_reported`, `report_m_id`, `report_b_id`) VALUES ( '" . $_SESSION['user_id'] . "','$brgy','$sitio', '$com', 'pending', current_timestamp(), '" . $_SESSION['user_m_id'] . "', '" . $_SESSION['brgy'] . "')");
                                        if ($insert_report) {
                                            $last_id = mysqli_insert_id($con);
                                            mysqli_query($con,"INSERT INTO `tbl_report_status` (`s_status`, `s_report_id`, `s_date_updated`) VALUES ( 'pending', '$last_id', current_timestamp())");
                                            if ($fileCount>3){
                                                echo '<script>alert("Maximum of 3 photo only.");</script>';
                                            }else{
                                                for ($i = 0; $i < $fileCount; $i++) {
                                                    $filename = $_FILES['file']['name'][$i];
                                                    $uploadPath = '../upload/' . $filename;
                                                    mysqli_query($con, "INSERT INTO `tbl_report_image` (`img_name`, `img_path`, `img_report_id`) VALUES ( '$filename', '$uploadPath', '$last_id')");

                                                    move_uploaded_file($_FILES['file']['tmp_name'][$i], '../upload/' . $filename);
                                                    echo '<script>alert("Complaint sent.");window.open("user_complaint_tbl.php","_self");</script>';
                                                }
                                            }
                                        }
                                    }


                                }
                                ?>
                                <form method="post"  style="font-size: 12px" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <h6><span class="text-danger">*</span>Sitio / Street</h6>
                                        <input type="text" name="sitio" placeholder="Enter Sitio or Street name ....." class="form-control" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <h6><span class="text-danger">*</span>Select Barangay</h6>
                                        <select name="brgy" id="complaint" class="form-control" required>
                                            <option value="">-</option>
                                            <?php
                                            $brgy = mysqli_query($con,"select * from baranggay where m_id='".$_SESSION['user_m_id']."'");
                                            if (mysqli_num_rows($brgy)>0){
                                                while ($b=mysqli_fetch_assoc($brgy)){
                                                    ?>
                                                    <option value="<?=$b['b_id']?>"><?=ucwords($b['b_name'])?></option>
                                            <?php
                                                }
                                            }else{
                                                ?>
                                                <option value="">Baranggay is Empty.</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <h6><span class="text-danger">*</span>Select Common Complaint</h6>
                                        <select name="complaint" id="complaint" class="form-control" required>
                                            <option value="">-</option>
                                            <option value="hindi regular na pag kulekta ng basura">Hind regular na pag kulekta ng basura.</option>
                                            <option value="hindi maayus na segregation">Hindi maayos na Segregation</option>
                                            <option value="hind sumusunod sa schedule ng pangungulekta ng basura">Hindi sumusunod sa Schedule ng pangungulekta ng basura</option>
                                            <option value="kakulangan sa edukasyun tungkol sa pag-sasaayus ng basura">Kakulangan sa Edukasyon tungkol sa Pag-sasaayos ng Basura</option>
                                            <option value="2">Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="other" style="display: none;">
                                        <h6><span class="text-danger">*</span>Custom complaint</h6>
                                        <textarea class="form-control" name="report_m" id=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <h6><span class="text-danger">*</span>Captured Photo <i>(Maximum 3 photo only.)</i></h6>
                                        <input type="file" accept=".jpg,.jpeg,.png" class="form-control "  placeholder="Upload Photo" name="file[]" title="Upload Photo" multiple required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" name="send_report">Submit</button>
                                </form>
                                <script>
                                    document.getElementById('complaint').addEventListener('change', function() {
                                        var otherDiv = document.getElementById('other');
                                        if (this.value === '2') {
                                            otherDiv.style.display = 'block';
                                        } else {
                                            otherDiv.style.display = 'none';
                                        }
                                    });
                                </script>
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
