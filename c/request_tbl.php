<?php
session_start();
include "../connection.php";

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

    <title>Request Table | E-Kolek</title>

    <!-- Custom fonts for this template-->

    <link href=".././vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href=".././css/admin-2.min.css" rel="stylesheet">
    <link rel="icon" href=".././img/recycle.png">
    <script src="../a/script.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
                                    <a class="text-decoration-none text-dark" href="collector_main.php" ><i class="fa fa-arrow-left fa-lg"></i></a>
                                </div>
                                <div class="float-left ml-2">
                                    <img src="../img/recycle.png" alt=""  class="img-thumbnail mx-2" width="40" height="40">
                                </div>
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-3" style="font-size: 30px;font-weight: bolder;">E-Kolek</h1>
                                </div>
                                <div class="text-center my-3">
                                    <h4 class="text-gray-900 " style="font-weight: bolder;">User Requests</h4>
                                </div>
                                <div class="table" style="font-size: small">
                                    <table id="example" class="display table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-wrap">#</th>
                                            <th>Date Posted</th>
                                            <th>Requester</th>
                                            <th>Request</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $request=mysqli_query($con," SELECT tbl_user.*,tbl_request.* FROM `tbl_request`inner join tbl_user on tbl_request.r_user_id=tbl_user.user_id order by r_id DESC");
                                        if (mysqli_num_rows($request)>0){
                                            $i=0;
                                            while ($r=mysqli_fetch_assoc($request)){
                                                $i++;
                                                ?>
                                                <tr>
                                                    <th><?=$i?></th>
                                                    <td><?=date('M d',strtotime($r['date_posted']))." at ".date('H:i',strtotime($r['date_posted']))?></td>
                                                    <td><?=$r['fname']." ".$r['mname']." ".$r['lname']?></td>
                                                    <td><?=$r['request']?></td>
                                                    <td><?=date('M d, Y',strtotime($r['request_date']))?></td>
                                                    <td>
                                                        <?php
                                                        if ($r['r_status']=="approved"){
                                                            echo '  <span class="badge badge-success">'.ucwords($r['r_status']).'</span>';
                                                        }
                                                        elseif ($r['r_status']=="on-process" or $r['r_status']=="pending"){
                                                           echo '  <span class="badge badge-info">'.ucwords($r['r_status']).'</span>';
                                                        }
                                                        elseif ($r['r_status']=="done") {
                                                            echo '<span class="badge badge-info">' . ucwords($r['r_status']) . '</span>';
                                                        }
                                                        ?>
                                                      </td>
                                                    <td>
                                                        <?php
                                                            if ($r['r_status']=="approved"){
                                                                ?>
                                                                <form action="" method="post">
                                                                    <input type="hidden" value="<?=$r['r_id']?>" name="r_id">
                                                                       <button class="btn btn-primary btn-sm" type="submit" name="on-process">On-Process</button>
                                                                </form>
                                                                <?php
                                                            }
                                                            elseif ($r['r_status']=="on-process"){
                                                                ?>
                                                                <form action="" method="post">
                                                                    <input type="hidden" value="<?=$r['r_id']?>" name="r_id">
                                                                    <button class="btn btn-primary btn-sm" type="submit" name="done">Done</button>
                                                                </form>
                                                                <?php
                                                            }
                                                            elseif ($r['r_status']=="done"){
                                                                echo '<span class="text-success" style="font-size: 30px"><i class="fa fa-check-circle" title="Done"></i></span>';
                                                            }
                                                            elseif($r['r_status']=="pending") {
                                                                echo "Waiting for Approval of Admin";
                                                            }
                                                            ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Date Posted</th>
                                            <th>Requester</th>
                                            <th>Request</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                        </tr>
                                        </tfoot>
                                    </table>
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
<script src=".././vendor/jquery/jquery.min.js"></script>
<script src=".././vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src=".././vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src=".././js/sb-admin-2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            scrollY: 200,
            scrollX: true,
        });
    });
</script>

</body>

</html>
<?php
if (isset($_POST['done'])){
    $r_id=$_POST['r_id'];
    $up2=mysqli_query($con,"UPDATE `tbl_request` SET `r_status` = 'done' WHERE `tbl_request`.`r_id` = '$r_id'");
    if ($up2===true){
        echo '<script>alert("Request is Done");window.open("request_tbl.php","_self");</script>';
    }
}
if (isset($_POST['on-process'])){
    $r_id=$_POST['r_id'];
    $up1=mysqli_query($con,"UPDATE `tbl_request` SET `r_status` = 'on-process' WHERE `tbl_request`.`r_id` = '$r_id'");
    if ($up1===true){
        echo '<script>alert("Status is On Process");window.open("request_tbl.php","_self");</script>';
    }
}

