<?php
include "../connection.php";
if (isset($_POST['register'])){
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];
    $municipality=$_POST['municipality'];
    $brgay=$_POST['baranggay'];
    $phone=$_POST['phone'];

    $encrypPass=sha1($pass);

    $file = $_FILES['file'];
    // File properties
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $uploadPath = "../upload/" . $fileName;

    $select_email=mysqli_query($con,"select * from tbl_user where email='$email'");
    if(mysqli_num_rows($select_email)>0){
        echo '<script>alert("Email exists. Use another email.")</script>';
    }else{
        $insert=mysqli_query($con,"INSERT INTO `tbl_user` ( `username`, `password`, `email`, `fname`, `mname`, `lname`, `user_type`, `user_m_id`,brgy,phone,photo) VALUES ( '$username', '$encrypPass', '$email', '$fname', '$mname', '$lname', '3', '$municipality','$brgay','$phone','$uploadPath')");
        if ($insert){
            move_uploaded_file($fileTmp, $uploadPath);
            echo '<script>alert("Successfully created your collector account.");window.open("../c/collector.php","_self");</script>';
        }else{
            echo '<script>alert("Error encounter while creating your collector account.")</script>';
        }
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

    <title>E-Kolek - Collector Register</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="../css/admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="../img/recycle.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $("#municipality").change(function() {
                var municipalityId = $(this).val();

                // Send AJAX request to fetch corresponding barangays
                $.ajax({
                    url: "get_baranggay.php",
                    type: "POST",
                    data: { municipalityId: municipalityId },
                    success: function(data) {
                        // Update the barangay selection
                        $("#barangay").html(data);
                    }
                });
            });
        });
    </script>
</head>

<body class="bg-gradient-success">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6">
     <div class="card o-hidden border-0 shadow-lg my-4">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Collector Registration!</h1>
                        </div>
                        <hr>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-sm-5 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="fname" required autofocus>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control form-control-user mb-3" placeholder="M.I." name="mname" required>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="lname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"  placeholder="Username" name="username" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="pass" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="cpass" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="myInput" type="number" min="0" maxlength="11" class="form-control form-control-user"  placeholder="Contact Number" name="phone" required>
                            </div>
                            <div class="form-group">
                                <select name="municipality" id="municipality" class="form-control form-control-user" required>
                                    <option >Select Municipality</option>
                                    <?php
                                    $mun=mysqli_query($con,"SELECT * FROM municpality ORDER BY m_name ASC;");
                                    if (mysqli_num_rows($mun)>0){
                                        while ($m=mysqli_fetch_assoc($mun)){
                                            echo '<option value="'.$m['m_id'].'">'.$m['m_name'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="barangay" name="baranggay" class="form-control form-control-user">
                                    <option >Select Baranggay</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="file" accept=".jpg,.jpeg,.png" class="form-control "  placeholder="Upload Photo" name="file" title="Upload Photo" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="register">Register Account</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="text-decoration-none" href="forgot-password.php">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="text-decoration-none" href="collector.php">Already have an account? Login!</a>
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
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

</body>

</html>