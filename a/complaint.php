<?php
include "header.php";
include "../connection.php";
?>
    <style>
        .btn-shadow {
            box-shadow: 0px 2px 4px rgba(28, 26, 26, 0.2);
        }
    </style>
    <body id="page-top" onload="startTime()">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include "sidebar.php";
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <h5 class="mx-2 my-2 font-weight-bold">Waste Management System</h5>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div id="clock" style="font-weight: bold; color:#1f1919;font-family:" Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol""></div>
                        <div id="date" style="color: #0c0808" class="mx-2"> | <?php echo date('l, F j, Y'); ?></div>
            </ul>
            </nav>

            <div class="container-fluid">
                <script>
                    function reload(){
                        window.open("complaint.php","_self");
                    }
                </script>
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Complaint List<span class="ml-2"><button type="button" class="btn btn-primary bnt-sm" onclick="reload()">Reload</button></span></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Complaint</li>
                        </ol>
                    </nav>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Action</th>
                                <th>Complainant</th>
                                <th>Sitio</th>
                                <th>Baranggay</th>
                                <th>Complaint</th>
                                <th>Image Complaint</th>
                                <th>Date Complaint</th>
                                <th>Status</th>
                                <th>Rate</th>
                                <th>Feedback/Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($_POST['change'])){
                                $r_id=$_POST['r_id'];
                                $status=mysqli_query($con,"UPDATE `tbl_report` SET `status` = 'on-process' WHERE `tbl_report`.`report_id` = '$r_id'");
                                if($status==true){
                                    mysqli_query($con,"INSERT INTO `tbl_report_status` (`s_status`, `s_report_id`, `s_date_updated`) VALUES ('on-process', '$r_id', current_timestamp())");
                                    echo '<script>alert("Status updated successful");window.open("complaint.php","_self")</script>';
                                }
                            }
                            if (isset($_POST['verified'])){
                                $r_id=$_POST['r_id'];
                                $update=mysqli_query($con,"UPDATE `tbl_report` SET `status` = 'verified' WHERE `tbl_report`.`report_id` = '$r_id'");
                                if ($update===true){
                                    mysqli_query($con,"INSERT INTO `tbl_report_status` ( `s_status`, `s_report_id`, `s_date_updated`) VALUES ( 'verified', '$r_id', current_timestamp())");
                                    echo '<script>alert("Complaint is verified");window.open("complaint.php","_self")</script>';
                                }

                            }
                            if (isset($_POST['false'])){
                                $r_id=$_POST['r_id'];
                                $update2=mysqli_query($con,"UPDATE `tbl_report` SET `status` = 'false-complaint' WHERE `tbl_report`.`report_id` = '$r_id'");
                                if ($update2===true){
                                    mysqli_query($con,"INSERT INTO `tbl_report_status` ( `s_status`, `s_report_id`, `s_date_updated`) VALUES ( 'false-complaint', '$r_id', current_timestamp())");
                                    echo '<script>alert("False Complaint.");window.open("complaint.php","_self")</script>';
                                }
                            }
                            if (isset($_GET['barangay'])){
                                $b=strtolower($_GET['barangay']);
                                $view_report = mysqli_query($con, "SELECT tbl_user.*, tbl_report.*,baranggay.* FROM tbl_user inner JOIN tbl_report ON tbl_report.report_user_id = tbl_user.user_id inner join baranggay on tbl_report.r_brgy=baranggay.b_id where b_name='$b' ORDER BY tbl_report.date_reported  DESC");
                                if (mysqli_num_rows($view_report)>0){
                                    $i=0;
                                    while ($vr = mysqli_fetch_assoc($view_report)) {
                                        $is="ids-".$i;
                                        $isi="idsi-".$i;
                                        $ir="idr-".$i;
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php
                                                if ($vr['status']=="on-process"){
                                                    ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="r_id" value="<?=$vr['report_id']?>">
                                                        <button type="submit" class="btn btn-outline-primary btn-sm btn-shadow my-1 " style="border-radius: 15px" name="verified">Verified</button>
                                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-shadow" style="border-radius: 15px" name="false">False Complaint</button>
                                                    </form>
                                                    <?php
                                                }
                                                elseif ($vr['status']=="pending"){
                                                    ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="r_id" value="<?=$vr['report_id']?>">
                                                        <div class="dropdown">
                                                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle btn-shadow"  style="border-radius: 15px" type="button" data-toggle="dropdown" aria-expanded="false">
                                                                Update Status
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><button class="dropdown-item btn btn-sm "  style="border-radius: 15px" type="submit" name="change">On-Process</button></li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                    <?php
                                                }
                                                elseif ($vr['status']=="rated"){
                                                    echo '<span class="text-success" style="font-size: 30px"><i class="fa fa-check-circle" title="Completed"></i></span>';
                                                }
                                                elseif ($vr['status']=="verified"){
                                                    echo '<span class="text-primary" style="font-size: 30px"><i class="fa fa-truck-loading" title="Schedule for Pick-up"></i></span>';
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
                                                        <a href="<?=$sp['img_path']?>" target="_blank" onclick="window.open(this.href,width=600,height=800); return false;"><img src="<?=$sp['img_path']?>" alt="" class="img-thumbnail" width="100" height="100"></a>
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
                                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalToggleLabel2">Proof of Pick-Up</h5>
                                                                                                    </div>
                                                                                                    <div class="modal-body text-center">
                                                                                                 <?php
                                                                                                 if ($vr['r_proof']!=""){
                                                                                                     echo ' <img src='.$vr['r_proof'].' alt="" width="50%" height="50%" class="img-thumbnail">';
                                                                                                 }
                                                                                                 else{
                                                                                                     echo '  <div class="alert alert-info text-center" role="alert">
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
                                                        echo ucfirst(base64_decode($feedback['rf_feedback']));
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
                            }else{
                                $view_report = mysqli_query($con, "SELECT tbl_user.*, tbl_report.*,baranggay.* FROM tbl_user inner JOIN tbl_report ON tbl_report.report_user_id = tbl_user.user_id inner join baranggay on tbl_report.r_brgy=baranggay.b_id ORDER BY tbl_report.date_reported  DESC");
                                if (mysqli_num_rows($view_report)>0){
                                    $i=0;
                                    while ($vr = mysqli_fetch_assoc($view_report)) {
                                        $is="ids-".$i;
                                        $isi="idsi-".$i;
                                        $ir="idr-".$i;
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php
                                                if ($vr['status']=="on-process"){
                                                    ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="r_id" value="<?=$vr['report_id']?>">
                                                        <button type="submit" class="btn btn-outline-primary btn-sm btn-shadow my-1 " style="border-radius: 15px" name="verified">Verified</button>
                                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-shadow" style="border-radius: 15px" name="false">False Complaint</button>
                                                    </form>
                                                    <?php
                                                }
                                                elseif ($vr['status']=="pending"){
                                                    ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="r_id" value="<?=$vr['report_id']?>">
                                                        <div class="dropdown">
                                                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle btn-shadow"  style="border-radius: 15px" type="button" data-toggle="dropdown" aria-expanded="false">
                                                                Update Status
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><button class="dropdown-item btn btn-sm "  style="border-radius: 15px" type="submit" name="change">On-Process</button></li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                    <?php
                                                }
                                                elseif ($vr['status']=="rated"){
                                                    echo '<span class="text-success" style="font-size: 30px"><i class="fa fa-check-circle" title="Completed"></i></span>';
                                                }
                                                elseif ($vr['status']=="verified"){
                                                    echo '<span class="text-primary" style="font-size: 30px"><i class="fa fa-truck-loading" title="Schedule for Pick-up"></i></span>';
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
                                                        <a href="<?=$sp['img_path']?>" target="_blank" onclick="window.open(this.href,width=600,height=800); return false;"><img src="<?=$sp['img_path']?>" alt="" class="img-thumbnail" width="100" height="100"></a>
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
                                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalToggleLabel2">Proof of Pick-Up</h5>
                                                                                                    </div>
                                                                                                    <div class="modal-body text-center">
                                                                                                 <?php
                                                                                                 if ($vr['r_proof']!=""){
                                                                                                     echo ' <img src='.$vr['r_proof'].' alt="" width="50%" height="50%" class="img-thumbnail">';
                                                                                                 }
                                                                                                 else{
                                                                                                     echo '  <div class="alert alert-info text-center" role="alert">
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
                                                        echo ucfirst(base64_decode($feedback['rf_feedback']));
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
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->
    </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center ">
                    <span>Copyright &copy; Waste Management System 2023</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    <!-- End of Content Wrapper -->

    </body>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>