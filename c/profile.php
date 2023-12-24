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

    <title>User Profile | E-Kolek</title>

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
                                <?php
                                if (isset($_POST['updatePass'])){
                                    $new=$_POST['newpass'];
                                    $cpass=$_POST['cpass'];

                                    if ($new==$cpass){
                                        $enctype=sha1($new);
                                        $uP=mysqli_query($con,"UPDATE `tbl_user` SET `password` = '$enctype' WHERE `tbl_user`.`user_id` = '".$_SESSION['user_id']."'");
                                        if ($uP){
                                            echo '<script>alert("Password changed successful.");window.open("profile.php","_self");</script>';
                                        }
                                    }else{
                                        echo '<script>alert("Password does not match. Try again...");</script>';
                                    }
                                }
                                ?>
                                <!-- Modal -->
                                <div class="modal fade" id="updatePass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="" method="post">
                                            <div class="modal-header text-center">
                                                <h1 class="modal-title " id="exampleModalLabel" style="font-size: 20px;">Update Password</h1>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-sm-12">
                                                    <input type="password" class="form-control form-control-user mb-3" minlength="8" placeholder="New Password" name="newpass" required>
                                                </div>
                                                <div class="col-sm-12">
                                                    <input type="password" class="form-control form-control-user" minlength="8" id="exampleLastName" placeholder="Confirm Password" name="cpass" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-sm" name="updatePass">Update</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (isset($_POST['updatePhoto'])){

                                    $file = $_FILES['file'];
                                    // File properties
                                    $fileName = $file['name'];
                                    $fileTmp = $file['tmp_name'];
                                    $uploadPath = "../upload/" . $fileName;

                                    $photo=mysqli_query($con,"UPDATE `tbl_user` SET `photo` = '$uploadPath' WHERE `tbl_user`.`user_id` = '".$_SESSION['user_id']."'");

                                    if ($photo){
                                        move_uploaded_file($fileTmp, $uploadPath);
                                        echo '<script>alert("Photo changed successful.");window.open("profile.php","_self");</script>';
                                    }
                                }
                                ?>
                                <!-- Modal -->
                                <div class="modal fade" id="updatePhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="modal-header text-center">
                                                    <h1 class="modal-title " id="exampleModalLabel" style="font-size: 20px;">Change Photo</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="file" accept=".jpg,.jpeg,.png" class="form-control "  placeholder="Upload Photo" name="file" title="Upload Photo" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary btn-sm" name="updatePhoto">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <a class="text-decoration-none text-dark" href="collector_main.php" title="Main Menu"><i class="fa fa-arrow-left fa-lg"></i></a>
                                </div>
                                <div class="float-left ml-2">
                                    <img src="../img/recycle.png" alt=""  class="img-thumbnail mx-2" width="40" height="40">
                                </div>
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-3" style="font-size: 30px;font-weight: bolder;">E-Kolek</h1>
                                </div>
                                <div class="text-center">
                                    <h2 class="h4 text-gray-900 mb-3" style="font-weight: bolder;">User Profile</h2>
                                </div>
                                <div class="text-center">
                                    <img src="<?=$u['photo']?>" alt=""  class="rounded-circle align-items-center" style="border:1px solid black;" width="150" height="150">
                                </div>
                                <br>
                                <form method="post"  style="font-size: 12px">
                                    <div class="form-group row">
                                        <div class="col-sm-5 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="fname"  autofocus value="<?=$u['fname']?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control form-control-user mb-3" placeholder="M.I." name="mname" required  value="<?=$u['mname']?>">
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="lname" value="<?=$u['lname']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" value="<?=$u['email']?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"  placeholder="Username" name="username"  value="<?=$u['username']?>">
                                    </div>
                                    <div class="form-group">
                                        <input id="myInput" type="number" min="0" maxlength="11" class="form-control form-control-user"  placeholder="Contact Number" name="phone"  value="<?=$u['phone']?>">
                                    </div>
                                    <div class="form-group">
                                        <select name="municipality" id="municipality" class="form-control form-control-user" >
                                            <option >Select Municipality</option>
                                            <?php
                                            $mun=mysqli_query($con,"SELECT * FROM municpality ORDER BY m_name ASC;");
                                            if (mysqli_num_rows($mun)>0){
                                                while ($m=mysqli_fetch_assoc($mun)){
                                                    if ($u['user_m_id']==$m['m_id']) {
                                                        echo '<option value="' . $m['m_id'] . '" selected>' . $m['m_name'] . '</option>';
                                                    }else{
                                                        echo '<option value="' . $m['m_id'] . '">' . $m['m_name'] . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select  name="baranggay" class="form-control form-control-user">
                                            <option >Select Baranggay</option>
                                            <?php
                                            $br=mysqli_query($con,"SELECT * FROM baranggay where m_id='".$u['user_m_id']."' ORDER BY b_name ASC;");
                                            if (mysqli_num_rows($br)>0){
                                                while ($b=mysqli_fetch_assoc($br)){
                                                    if ($u['brgy']==$b['b_id']) {
                                                        echo '<option value="' . $b['b_id'] . '" selected>' . $b['b_name'] . '</option>';
                                                    }else{
                                                        echo '<option value="' . $b['b_id'] . '">' . $b['b_name'] . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" name="update">Update Account</button>
                                </form>
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
