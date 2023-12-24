<?php
session_start();
$email = $_GET['email'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>E-Kolek - Verify Email</title>

        <!-- Custom fonts for this template-->
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../css/admin-2.min.css" rel="stylesheet">
        <link rel="icon" href="../img/recycle.png">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>

    <body class="bg-gradient-success">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center mt-5">

            <div class="col-lg-6 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your new password and confirm it, to reset your old password!</p>
                                    </div>
                                    <form method="post" action="">
                                        <div class="form-group ">
                                            <input type="password" name="password" class="form-control"  required autofocus placeholder="Enter new Password" minlength="8">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="cpassword" class="form-control"  required placeholder="Confirm new Password" minlength="8">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block" name="resetpw">Reset Password</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="text-decoration-none" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="text-decoration-none" href="index.php">Already have an account? Login!</a>
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
<?php
if(isset($_POST["resetpw"])) {
    include "../connection.php";
    $cpsw=$_POST['cpassword'];
    $psw = $_POST["password"];
    $email = $_GET['email'];

    if ($psw != $cpsw){
        echo '<script>alert("Password does not match. Please try again...");</script>';
    }else{
        $hash = sha1($psw);

        //filter data for end-user
        $user = mysqli_query($con, "Select * from tbl_user where email = '$email'");
        $resultuser = mysqli_num_rows($user);
        $fetchuser = mysqli_fetch_assoc($user);

        if ($email == $fetchuser['email']) {
            $new_pass = $hash;
            mysqli_query($con, "UPDATE tbl_user SET password='$new_pass' WHERE email='$email'");

            ?>
            <script>
                window.location.replace("../index.php");
                alert("<?php echo "Your password has been successful reset!"?>");
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("<?php echo "Please try again"?>");
            </script>
            <?php
        }
    }
}
?>