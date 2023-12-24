<?php
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Kolek - User Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="../img/recycle.png">
    <style>
        .d-none {
            display: none;
        }
    </style>
    <?php
    $output="";
    if(isset($_POST["recover"])){
        session_start();
        $email = $_POST["email"];

        $user = mysqli_query($con, "Select * from tbl_user where email = '$email'");
        $fetchuser = mysqli_fetch_assoc($user);

        if (mysqli_num_rows($user) == 0 ){
            $output='<div class="alert alert-danger" role="alert">
  <strong>Error.</strong>No email exist.
</div>';
        }elseif (mysqli_num_rows($user) > 0 ){
            if ($fetchuser['accnt_status'] == "inactive"){
                $output='<div class="alert alert-danger" role="alert">
  <strong>Error.</strong>Your account is inactive you cannot change password! Please contact your administrator.
</div>';
            }else{
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;

                $to = $email;
                $subject = "Password Recovery";
                $txt = "Dear $email,\n\n\tWe received a request to reset your password. \n\tYour OTP code is $otp.\n\n\t\t (This is system generated email. Don't reply.)";
                $header = "From: mail.verifier2022@gmail.com(Administrator of Waste Management System Reset Password Request)";
                if (mail($to, $subject, $txt, $header)) {
                    ?>
                    <script>
                        alert("<?php echo "Password Recovery, OTP sent to " . $email . "  in order to recover your account." ?>");
                        window.location.replace("verification_pw.php?email=<?php echo $email?>");
                    </script>
                    <?php
                } else {
                    $output='<div class="alert alert-danger" role="alert">
  <strong>Error.</strong> Please check your internet connection or the email you entered.
</div>';
                }
            }
        } else {
            $output='<div class="alert alert-danger" role="alert">
  <strong>Error.</strong>  Something went wrong during selection!
</div>';
        }
    }
    ?>
    <script>
        function showDiv() {
            var divElement = document.getElementById('myDiv');
            divElement.classList.remove('d-none');
        }
    </script>
</head>

<body class="bg-gradient-success">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-3">

        <div class="col-lg-6 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <?=$output?>
                                    <div class="alert alert-success d-none" id="myDiv" role="alert">
                                        Processing in progress...
                                        <div class="spinner-grow ml-2" role="status">
                                            <span class="visually-hidden"></span>
                                        </div>
                                    </div>
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                    <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                        and we'll send you an OTP to reset your password!</p>
                                </div>
                                <form method="post" action="">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" placeholder="Enter Email Address..." name="email" id="Email" autofocus>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" id="submitBtn" name="recover" onclick="showDiv()"> Submit</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="text-decoration-none" href="register.php">Create an Account!</a>
                                </div>
                                <div class="text-center">
                                    <a class="text-decoration-none" href="user.php">Already have an account? Login!</a>
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