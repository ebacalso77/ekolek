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

    <title>Collector Complaint List | E-Kolek</title>

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
                                    <h4 class="text-gray-900 " style="font-weight: bolder;">Complaint List</h4>
                                </div>
                                <div class="table" style="font-size: small">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Complainant</th>
                                            <th>Sitio</th>
                                            <th>Brgy</th>
                                            <th>Complaint</th>
                                            <th>Image Complaint</th>
                                            <th>Date Complaint</th>
                                            <th>Status</th>
                                            <th><a title="1-Poor | 2-Fair | 3-Good | 4-Better | 5-Best" class="text-decoration-none text-dark">Rate</a></th>
                                            <th>Feedback/Comment</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Action</th>
                                            <th>Complainant</th>
                                            <th>Sitio</th>
                                            <th>Brgy</th>
                                            <th>Complaint</th>
                                            <th>Image Complaint</th>
                                            <th>Date Complaint</th>
                                            <th>Status</th>
                                            <th><a  title="1-Poor | 2-Fair | 3-Good | 4-Better | 5-Best" class="text-decoration-none text-dark">Rate</a></th>
                                            <th>Feedback/Comment</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                        $view_report = mysqli_query($con, "SELECT tbl_user.*, tbl_report.*,baranggay.* FROM tbl_user inner JOIN tbl_report ON tbl_report.report_user_id = tbl_user.user_id inner join baranggay on tbl_report.r_brgy=baranggay.b_id  where tbl_report.r_brgy='".$_SESSION['brgy']."' ORDER BY tbl_report.date_reported  DESC");
                                        if (mysqli_num_rows($view_report)>0){
                                            $i=0;
                                            while ($vr = mysqli_fetch_assoc($view_report)) {
                                                $is="ids-".$i;
                                                $isi="idsi-".$i;
                                                $ir="idr-".$i;
                                                $im="idm-".$i;
                                                $ip="idp-".$i;
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($vr['status']=="on-process"){
                                                            if (isset($_POST['verified'])){
                                                                $update=mysqli_query($con,"UPDATE `tbl_report` SET `status` = 'verified' WHERE `tbl_report`.`report_id` = '".$vr['report_id']."'");
                                                                if ($update===true){
                                                                    mysqli_query($con,"INSERT INTO `tbl_report_status` ( `s_status`, `s_report_id`, `s_date_updated`) VALUES ( 'verified', '".$vr['report_id']."', current_timestamp())");
                                                                    echo '<script>alert("Complaint is verified");window.open("complaint.php","_self")</script>';
                                                                }

                                                            }
                                                            if (isset($_POST['false'])){
                                                                $update2=mysqli_query($con,"UPDATE `tbl_report` SET `status` = 'false-complaint' WHERE `tbl_report`.`report_id` = '".$vr['report_id']."'");
                                                                if ($update2===true){
                                                                    mysqli_query($con,"INSERT INTO `tbl_report_status` ( `s_status`, `s_report_id`, `s_date_updated`) VALUES ( 'false-complaint', '".$vr['report_id']."', current_timestamp())");
                                                                    echo '<script>alert("False Complaint.");window.open("complaint.php","_self")</script>';
                                                                }
                                                            }
                                                            ?>
                                                            <form action="" method="post">
                                                                <button type="submit" class="btn btn-primary btn-sm" name="verified">Verified</button>
                                                                <button type="submit" class="btn btn-danger btn-sm" name="false">False Complaint</button>
                                                            </form>
                                                            <?php
                                                        }
                                                        elseif ($vr['status']=="pending"){
                                                            if (isset($_POST['change'])){
                                                                $status=mysqli_query($con,"UPDATE `tbl_report` SET `status` = 'on-process' WHERE `tbl_report`.`report_id` = '".$vr['report_id']."'");
                                                                if($status==true){
                                                                    mysqli_query($con,"INSERT INTO `tbl_report_status` (`s_status`, `s_report_id`, `s_date_updated`) VALUES ('on-process', '".$vr['report_id']."', current_timestamp())");
                                                                    echo '<script>alert("Status updated successful");window.open("complaint.php","_self")</script>';
                                                                }
                                                            }
                                                            ?>
                                                            <form action="" method="post">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                                        Update Status
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><button class="dropdown-item btn btn-outline-primary" type="submit" name="change">On-Process</button></li>
                                                                    </ul>
                                                                </div>
                                                            </form>
                                                            <?php
                                                        }
                                                        elseif ($vr['status']=="rated"){
                                                            echo '<span class="text-success" style="font-size: 30px"><i class="fa fa-check-circle" title="Completed"></i></span>';
                                                        }
                                                        elseif ($vr['status']=="verified"){
                                                                echo '<button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#'.$ip.'">Upload Proof</button>';
                                                            if (isset($_POST['update_c'])){
                                                                $r_id=$_POST['r_id'];
                                                                $file = $_FILES['file'];
                                                                // File properties
                                                                $fileName = $file['name'];
                                                                $fileTmp = $file['tmp_name'];
                                                                $uploadPath = "../upload/" . $fileName;

                                                                $update_stats=mysqli_query($con,"UPDATE `tbl_report` SET `status` = 'done', `r_proof` = '$uploadPath', `r_posted_proof` = current_timestamp() WHERE `tbl_report`.`report_id` = '".$vr['report_id']."'");
                                                                if ($update_stats===true){
                                                                    move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath);
                                                                    mysqli_query($con,"INSERT INTO `tbl_report_status` ( `s_status`, `s_report_id`, `s_date_updated`) VALUES ( 'done', '$r_id', current_timestamp())");
                                                                    echo '<script>alert("Done Uploading.");window.open("complaint_tbl.php","_self")</script>';
                                                                }
                                                            }
                                                            ?>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="<?=$ip?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form action="" method="post" enctype="multipart/form-data">
                                                                    <div class="modal-content ">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Upload Proof of Pickup</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <input type="hidden" name="r_id" value="<?=$vr['report_id']?>">
                                                                                <h6><span class="text-danger">*</span>Upload Photo</h6>
                                                                                <input type="file" accept=".jpg,.jpeg,.png" class="form-control "  placeholder="Upload Photo" name="file" title="Upload Photo" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary btn-sm" name="update_c">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <?php
                                                        }
                                                        elseif ($vr['status']=="false-complaint"){
                                                            echo '<span class="text-danger" style="font-size: 30px"><i class="fa fa-times-circle" title="False Complaint"></i></span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?=ucfirst($vr['fname']." ".$vr['lname'])?></td>
                                                    <td><?=ucwords($vr['r_sitio'])?></td>
                                                    <td><?=ucwords($vr['b_name'])?></td>
                                                    <td><?=ucwords($vr['message'])?></td>
                                                    <td>
                                                        <?php
                                                        $sel_p=mysqli_query($con,"SELECT * FROM `tbl_report_image` where img_report_id='".$vr['report_id']."'");
                                                        if (mysqli_num_rows($sel_p)>0){
                                                            while ($sp=mysqli_fetch_assoc($sel_p)){
                                                                ?>
                                                                <a href="" data-toggle="modal" data-target="#<?=$im?>"><img src="<?=$sp['img_path']?>" alt="" class="img-thumbnail" width="100" height="100"></a>
                                                        <!-- Modal Image -->
                                                        <div class="modal fade" id="<?=$im?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body text-center">
                                                                        <img src="<?=$sp['img_path']?>" alt="" class="img-thumbnail" width="50%" height="50%">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?=date('M d, Y',strtotime($vr['date_reported']))?></td>
                                                    <td style="font-size: 15px">
                                                        <a href="" class="text-decoration-none" data-toggle="modal" data-target="#<?=$is?>" title="Show Tracking Status">
                                                            <?php
                                                            if ($vr['status']=="pending"){
                                                                echo '<span class="badge badge-primary">'.ucwords($vr['status']).'</span>';
                                                            }elseif ($vr['status']=="on-process"){
                                                                echo '<span class="badge badge-info">'.ucwords($vr['status']).'</span>';
                                                            }elseif ($vr['status']=="verified" or $vr['status']=="done" or $vr['status']=="rated"){
                                                                echo '<span class="badge badge-success">'.ucwords($vr['status']).'</span>';
                                                            }elseif ($vr['status']=="false-complaint"){
                                                                echo '<span class="badge badge-danger">'.ucwords($vr['status']).'</span>';
                                                            }
                                                            ?>
                                                        </a>
                                                        <!-- Modal status -->
                                                        <div class="modal fade" id="<?=$is?>"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title " id="exampleModalLabel">Tracking Information</h5>
                                                                    </div>
                                                                    <div class="modal-body " style="font-size:15px">
                                                                        <?php
                                                                        $stat=mysqli_query($con,"SELECT * FROM `tbl_report_status` where s_report_id='".$vr['report_id']."' order by s_date_updated DESC");
                                                                        if (mysqli_num_rows($stat)>0){
                                                                            while ($st=mysqli_fetch_assoc($stat)){
                                                                                ?>
                                                                                <p class="mx-4"><?=date('M d',strtotime($st['s_date_updated'])).' at '.date('H:i',strtotime($st['s_date_updated']))?>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                <?php
                                                                                 if ($st['s_status']=="pending"){
                                                                                      echo '<span class="badge badge-primary">'.ucwords($st['s_status']).'</span>';
                                                                                  }elseif ($st['s_status']=="on-process"){
                                                                                      echo '<span class="badge badge-info">'.ucwords($st['s_status']).'</span>';
                                                                                  }elseif ($st['s_status']=="verified" or $st['s_status']=="done" or $st['s_status']=="rated"){
                                                                                      echo '<span class="badge badge-success">'.ucwords($st['s_status']).'</span>';
                                                                                  }elseif ($st['s_status']=="false-complaint"){
                                                                                      echo '<span class="badge badge-danger">'.ucwords($st['s_status']).'</span>';
                                                                                  }
                                                                                ?>

                                                                                <span class="mx-2">
                                                                                    <?php
                                                                                    if ($st['s_status']=="done"){
                                                                                        ?>
                                                                                        <a href="#"  role="button" data-target="#<?=$isi?>" data-toggle="modal" class="text-decoration-none">Proof of Pick-Up</a>
                                                                                        <div class="modal fade" id="<?=$isi?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-2">
                                                                                            <div class="modal-dialog">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalToggleLabel2">Proof of Pick-Up</h5>
                                                                                                    </div>
                                                                                                    <div class="modal-body text-center">
                                                                                                 <?php
                                                                                                     if ($vr['r_proof']==""){
                                                                                                          echo '
                                                                                                           <div class="alert alert-info text-center" role="alert">
                                                                                                                 No Proof submitted.
                                                                                                            </div>
                                                                                                           ';
                                                                                                     }else{
                                                                                                          echo ' <img src='.$vr['r_proof'].' alt="" width="50%" height="50%" class="img-thumbnail">';
                                                                                                     }
                                                                                                       ?>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <a href="#"  role="button" data-target="#<?=$isi?>" data-toggle="modal" class="text-decoration-none btn btn-secondary btn-sm">Close</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                            <?php
                                                                                    }
                                                                                    ?>
                                                                                </span>
                                                                                </p>
                                                                           <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                <td class="text-center">
                                    <?php
                                    $fb=mysqli_query($con,"SELECT * FROM tbl_report_feedback WHERE tbl_report_feedback.rf_report_id='".$vr['report_id']."'");
                                    if (mysqli_num_rows($fb)>0){
                                        $feedback=mysqli_fetch_assoc($fb);
                                        if ($feedback['rf_rate']< 75){
                                            echo '<span class="text-danger">'.$feedback['rf_rate'].' %  <i class="fa fa-arrow-down mx-1"></i></span>';
                                        }else{
                                            echo '<span class="text-success">'.$feedback['rf_rate'].' % <i class="fa fa-arrow-up mx-1"></i></span>';
                                        }
                                    }else{
                                        echo '
                                           <div class="alert alert-info text-center" role="alert">
                                                 No rated yet.
                                            </div>
                                           ';
                                    }
                                    ?>
                                </td>
                                                    <td class="text-wrap">
                                                        <?php
                                                        $fb=mysqli_query($con,"SELECT * FROM tbl_report_feedback WHERE tbl_report_feedback.rf_report_id='".$vr['report_id']."'");
                                                        if (mysqli_num_rows($fb)>0){
                                                            while ($feedback=mysqli_fetch_assoc($fb)){
                                                                if ($feedback['rf_feedback']=="") {
                                                                    echo '
                                           <div class="alert alert-info text-center" role="alert">
                                                 No Feedback Yet.
                                            </div>
                                           ';
                                                                }else{
                                                                    echo base64_decode($feedback['rf_feedback']);
                                                                }
                                                            }
                                                        }else{
                                                            echo '
                                           <div class="alert alert-info text-center" role="alert">
                                                 No Feedback Yet.
                                            </div>
                                           ';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
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
        $('#dataTable').DataTable({
            scrollY: 200,
            scrollX: true,
        });
    });
</script>

</body>

</html>
