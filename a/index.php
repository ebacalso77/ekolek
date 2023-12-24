<?php
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
if (isset($_POST['login'])) {// checking data input
    include "../connection.php";
    $username = htmlentities(stripslashes(mysqli_real_escape_string($con, $_POST['username'])));
    $password = htmlentities(stripslashes(mysqli_real_escape_string($con, $_POST['password'])));
    //checking data
    $user = mysqli_query($con, "SELECT * FROM tbl_user WHERE username='$username' and user_type=1 ");
    $countUser = mysqli_num_rows($user);
    $row=mysqli_fetch_assoc($user);
    if ($countUser == 0) {
        echo '<script>alert("User is not registered.");</script>';
    } else {
        session_start();
        if (sha1($password) === $row['password']) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['firstname'] = $row['fname'];
            $_SESSION['middlename'] = $row['mname'];
            $_SESSION['lastname'] = $row['lname'];
            $_SESSION['fullname'] = $row['fname'] . " " . $row['mname'] . " " . $row['lname'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['user_m_id'] = $row['user_m_id'];
            $_SESSION['photo'] = 'data:image/png;base64,' . $row['photo'];// decoding base64 file in to image
            echo '<script>window.open("dashboard.php?id=' . $_SESSION['user_id'] . '","_self");</script>';
        }else{
            echo '<script>alert("Access Denied!")</script>';
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

    <title>Administrator | E-Kolek</title>

    <!-- Custom fonts for this template-->

    <link href=".././vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href=".././css/admin-2.min.css" rel="stylesheet">
    <link rel="icon" href=".././img/recycle.png">
    <script src="script.js"></script>
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
                        <div class="col-lg-12" >
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Administrator Login</h1>
                                </div>
                                <form method="post" action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" placeholder="Username" name="username" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"  placeholder="Password" name="password" required minlength="8">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" name="login">Login</button>
                                </form>
                                <hr>
                                <div class="text-center" style="font-size: 15px">
                                    <a class="text-decoration-none" href="forgot-password.php">Forgot Password?</a>
                                </div>
                                <!--<div class="text-center">-->
                                <!--    <a class="text-decoration-none" href="register.php">Create an Account!</a>-->
                                <!--</div>-->
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
