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

    <title>User Report | E-Kolek</title>

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
                                    <a class="text-decoration-none text-dark" href="user_complaint.php" ><i class="fa fa-arrow-left fa-lg"></i></a>
                                </div>
                                <div class="float-left ml-2">
                                    <img src="../img/recycle.png" alt=""  class="img-thumbnail mx-2" width="40" height="40">
                                </div>
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-3" style="font-size: 30px;font-weight: bolder;">E-Kolek</h1>
                                </div>
                                <div class="text-center my-3">
                                    <h4 class="text-gray-900 " style="font-weight: bolder;">My Complaints</h4>
                                    <a href="user_complaint.php" class=" btn btn-primary btn-sm " ><i class="fa fa-plus mx-2"></i> Create complaint</a>
                                </div>
                                <div class="table" style="font-size: small">
                                    <table id="example" class="display table-hover">
                                        <thead>
                                        <tr>
                                            <th>Date Posted</th>
                                            <th>Sitio</th>
                                            <th>Baranggay</th>
                                            <th>Complaint</th>
                                            <th>Photo</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $select_com=mysqli_query($con,"SELECT tbl_user.*,tbl_report.*,tbl_report_image.*,baranggay.* FROM tbl_user inner join tbl_report on tbl_user.user_id=tbl_report.report_user_id inner join tbl_report_image on tbl_report.report_id=tbl_report_image.img_report_id left join baranggay on tbl_report.r_brgy=baranggay.b_id WHERE report_user_id='".$_SESSION['user_id']."' order by date_reported DESC");
                                        if (mysqli_num_rows($select_com)>0){
                                            $i=0;
                                            while ($c=mysqli_fetch_assoc($select_com)){
                                                $id="id-".$i;
                                                $im="idm-".$i;
                                                $is="ids-".$i;
                                                $isi="idsi-".$i;
                                                $ir="idr-".$i;
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td> <?=date('M d, Y',strtotime($c['date_reported']))?></td>
                                                    <td><?=ucwords($c['r_sitio'])?></td>
                                                    <td><?=ucwords($c['b_name'])?></td>
                                                    <td>
                                                        <?php
                                                        $mes= ucwords($c['message']);
                                                        $length=50;

                                                        if (strlen($mes) > $length) {
                                                            $trimmedMessage = substr($mes, 0, $length) . " .... <a href='' class='text-decoration-none' data-toggle='modal' data-target='#$id'>see more.</a>";
                                                        } else {
                                                            $trimmedMessage = $mes;
                                                        }
                                                        echo $trimmedMessage;
                                                        ?>
                                                        <!-- Modal message -->
                                                        <div class="modal fade" id="<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title " id="exampleModalLabel">Complaint</h5>
                                                                    </div>
                                                                    <div class="modal-body " style="font-size:15px">
                                                                        <?=base64_decode($c['message'])?>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="" data-toggle="modal" data-target="#<?=$im?>" class="text-decoration-none"><img src="<?=$c['img_path']?>" class="img-thumbnail" alt=""></a>
                                                        <!-- Modal photo -->
                                                        <div class="modal fade" id="<?=$im?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title " id="exampleModalLabel">Complaint Photo</h5>
                                                                    </div>
                                                                    <div class="modal-body " style="font-size:15px">
                                                                        <img src="<?=$c['img_path']?>" class="img-thumbnail" alt="" style="width: auto;height:auto ">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="font-size: 15px">
                                                        <a href="" class="text-decoration-none" data-toggle="modal" data-target="#<?=$is?>" title="Show Tracking Status">
                                                            <?php
                                                            if ($c['status']=="pending"){
                                                                echo '<span class="badge badge-primary">'.ucwords($c['status']).'</span>';
                                                            }elseif ($c['status']=="on-process"){
                                                                echo '<span class="badge badge-info">'.ucwords($c['status']).'</span>';
                                                            }elseif ($c['status']=="verified" or $c['status']=="done" or $c['status']=="rated"){
                                                                echo '<span class="badge badge-success">'.ucwords($c['status']).'</span>';
                                                            }elseif ($c['status']=="false-complaint"){
                                                                echo '<span class="badge badge-danger">'.ucwords($c['status']).'</span>';
                                                            }
                                                            ?>
                                                        </a>
                                                        <!-- Modal status -->
                                                        <div class="modal fade" id="<?=$is?>"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title " id="exampleModalLabel">Tracking Information</h5>
                                                                    </div>
                                                                    <div class="modal-body " style="font-size:15px">
                                                                        <?php
                                                                        $stat=mysqli_query($con,"SELECT * FROM `tbl_report_status` where s_report_id='".$c['report_id']."' order by s_date_updated DESC");
                                                                        if (mysqli_num_rows($stat)>0){
                                                                            while ($st=mysqli_fetch_assoc($stat)){
                                                                                ?>
                                                                                <p><?=date('M d',strtotime($st['s_date_updated'])).' at '.date('H:i',strtotime($st['s_date_updated']))?>&nbsp;&nbsp;&nbsp;&nbsp;
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
                                                                                        <a href="#"  role="button" data-target="#<?=$isi?>" data-toggle="modal" class="text-decoration-none">Proof of Pickup</a>
                                                                                        <div class="modal fade" id="<?=$isi?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-2">
                                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalToggleLabel2">Proof of Pickup</h5>
                                                                                                    </div>
                                                                                                    <div class="modal-body text-center">
                                                                                                 <?php

                                                                                                 if ($c['r_proof']!=""){
                                                                                                     echo ' <img src='.$c['r_proof'].' alt="" width="50%" height="50%" class="img-thumbnail">';
                                                                                                 }else{
                                                                                                         echo '  <div class="alert alert-danger text-center" role="alert">
                                                                                                                                                         No Proof submitted.
                                                                                                                                                    </div>
                                                                                                                                                   ';
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
                                                    <td>
                                                        <?php
                                                        if ($c['status']=="done" or $c['status']=="false-complaint") {
                                                            echo '<a href="user_complaint_tbl_rate.php?id='.$c['report_id'].'" class="btn btn-danger btn-sm">Rate</a>';
                                                        }elseif ($c['status']=="pending"){
                                                            echo '<a href="user_complaint_delete.php?r_id='.$c['report_id'].'" class="btn btn-danger btn-sm">Remove</a>';
                                                        }elseif ($c['status']=="rated"){
                                                            echo '<span class="text-success" style="font-size: 30px"><i class="fa fa-check-circle" title="Completed"></i></span>';
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
                                            <th>Date Posted</th>
                                            <th>Sitio</th>
                                            <th>Baranggay</th>
                                            <th>Complaint</th>
                                            <th>Photo</th>
                                            <th>Status</th>
                                            <th></th>
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