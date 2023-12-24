<?php
include "header.php";
include "../connection.php";
?>
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
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <h5 class="mx-2 my-2 font-weight-bold">Waste Management System</h5>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div id="clock" style="font-weight: bold; color:#1f1919;font-family:"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol""></div>
                        <div id="date" style="color: #0c0808" class="mx-2"> | <?php echo date('l, F j, Y'); ?></div>
                    </ul>


                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Home</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- 1st Content Row -->
                    <div class="row">
                        <!-- Total User -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="user.php" class="text-decoration-none">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $user=mysqli_query($con,"select * from tbl_user where user_type=2");
                                                if (mysqli_num_rows($user)>0){
                                                    echo mysqli_num_rows($user);
                                                }else{
                                                    echo "0";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <!-- Collector  -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="collector.php" class="text-decoration-none">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Collector</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $user=mysqli_query($con,"select * from tbl_user where user_type=3");
                                                if (mysqli_num_rows($user)>0){
                                                    echo mysqli_num_rows($user);
                                                }else{
                                                    echo "0";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <!-- Total complaint-->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="complaint.php" class="text-decoration-none">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Complaint</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                $report=mysqli_query($con,"select * from tbl_report");
                                                if (mysqli_num_rows($report)>0){
                                                    echo mysqli_num_rows($report);
                                                }else{
                                                    echo "0";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <!-- Total request-->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="request.php" class="text-decoration-none">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Request
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        $report2=mysqli_query($con,"select * from tbl_request");
                                                        if (mysqli_num_rows($report2)>0){
                                                           echo mysqli_num_rows($report2);
                                                        }else{
                                                            echo "0";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col">
<!--                                                    <div class="progress progress-sm mr-2">-->
<!--                                                        <div class="progress-bar bg-info" role="progressbar"-->
<!--                                                            style="width: --><?//=$r.'%'?><!--" aria-valuenow="--><?//=$r?><!--" aria-valuemin="0"-->
<!--                                                            aria-valuemax="100"></div>-->
<!--                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>

                    <!-- 2nd Content Row -->
                    <div class="row">
                        <!--Top Most Complaint -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-success">
                                    <h6 class="m-0 font-weight-bold text-light">Most Common Complaint</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="card-body">
                                        <?php
                                        $view_report =mysqli_query($con," SELECT message, COUNT(tbl_report.message) AS count_mes
FROM tbl_report 
GROUP BY tbl_report.message
ORDER BY count_mes DESC
LIMIT 8;
");

                                        // Check for query execution error
                                        if (!$view_report) {
                                            die("Query failed: " . mysqli_error($con));
                                        }
                                       if (mysqli_num_rows($view_report)>0){
                                           while ($vr=mysqli_fetch_assoc($view_report)){
                                               ?>
                                               <div class="row" style="font-size: 13px;">
<!--                                                   <div class="col-md-1 font-weight-bold text-dark">-->
<!--                                                      --><?//=$vr['count_mes']?>
<!--                                                   </div>-->
                                                   <div class="col-md-12">
                                                       <p class="">
                                                           <?php
                                                           echo ucfirst($vr['message']);
//                                                           $length=50;
//
//                                                           if (strlen($mes) > $length) {
//                                                               $trimmedMessage = substr($mes, 0, $length) . " ....";
//                                                           } else {
//                                                               $trimmedMessage = $mes;
//                                                           }
//                                                           echo $trimmedMessage;
//                                                           ?>
                                                           <br>
                                                       </p>
                                                   </div>
                                               </div>
                                                   <?php
                                           }
                                       }else{
                                           echo '
                                           <div class="alert alert-primary text-center" role="alert">
                                                 No report yet.
                                            </div>
                                           ';
                                       }
                                        ?>
                                        <a href="complaint.php" class="text-decoration-none">See more....</a>
                                    </div><!-- End News & Updates -->
                                </div>
                            </div>
                        </div>
                        <!--Completion Report -->
                        <div class="col-xl-4 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-secondary">
                                    <h6 class="m-0 font-weight-bold text-light">Completion Report</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="card-body pb-0">
                                        <?php
                                        $get_date_completion=mysqli_query($con,"SELECT tbl_user.* , tbl_collection_completion_report.* FROM tbl_collection_completion_report inner JOIN tbl_user on tbl_collection_completion_report.ccr_user_id=tbl_user.user_id  order by ccr_id DESC LIMIT 4");
                                        if (mysqli_num_rows($get_date_completion)>0){
                                            while ($vr=mysqli_fetch_assoc($get_date_completion)){
                                                ?>
                                                <div class="row" style="font-size: 12px;">
                                                    <div class="col-md-3">
                                                        <img src="<?=$vr['photo']?>" alt="" class="rounded-circle float-left bg-gradient-secondary mx-2" width="60" height="60" >
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h6><a  class="text-wrap text-decoration-none "><?=$vr['fname']." ".$vr['lname']?></a></h6>
                                                        <p class="text-wrap">
                                                        <p class="font-weight-bold">Total collected truck:  <span class="text-success"><?=$vr['ccr_total_truck']?></span><br>
                                                            <span class="font-weight-bold">Date Collection:</span> <?=date('d M Y',strtotime($vr['ccr_date_collection']))?>
                                                            <br><small><?=date('d M Y',strtotime($vr['ccr_date_reported']))." at ".date('H:i',strtotime($vr['ccr_date_reported']))?></small>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }else{
                                            echo '
                                           <div class="alert alert-primary text-center" role="alert">
                                                 No report yet.
                                            </div>
                                           ';
                                        }
                                        ?>
                                        <a href="completion.php" class="text-decoration-none">See more....</a>
                                    </div><!-- End News & Updates -->
                                </div>
                            </div>
                        </div>
                        <!--Bulletin Board Updates-->
                        <div class="col-xl-4 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info">
                                    <h6 class="m-0 font-weight-bold text-light">Bulletin Board Updates </h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="card-body pb-0">
                                        <?php
                                        $get_data=mysqli_query($con," SELECT
       tbl_user.*, tbl_bulletin.*,
    CASE
        WHEN tbl_bulletin.b_posted_date > NOW() - INTERVAL 1 MINUTE THEN 'Just now'
        WHEN tbl_bulletin.b_posted_date > NOW() - INTERVAL 1 HOUR THEN CONCAT(TIMESTAMPDIFF(MINUTE, tbl_bulletin.b_posted_date, NOW()), ' minutes ago')
        WHEN tbl_bulletin.b_posted_date > NOW() - INTERVAL 1 DAY THEN CONCAT(TIMESTAMPDIFF(HOUR, tbl_bulletin.b_posted_date, NOW()), ' hours ago')
        WHEN tbl_bulletin.b_posted_date > NOW() - INTERVAL 1 MONTH THEN CONCAT(TIMESTAMPDIFF(DAY, tbl_bulletin.b_posted_date, NOW()), ' days ago')
        WHEN tbl_bulletin.b_posted_date > NOW() - INTERVAL 1 YEAR THEN CONCAT(TIMESTAMPDIFF(MONTH,tbl_bulletin.b_posted_date, NOW()), ' months ago')
        ELSE CONCAT(TIMESTAMPDIFF(YEAR, tbl_bulletin.b_posted_date, NOW()), ' years ago')
    END AS time_difference
FROM
    tbl_bulletin
INNER JOIN tbl_user ON tbl_bulletin.posted_by = tbl_user.user_id 
ORDER BY tbl_bulletin.b_posted_date DESC
LIMIT 4;
");
                                        // Check for query execution error
                                        if (!$get_data) {
                                            die("Query failed: " . mysqli_error($con));
                                        }
                                        if (mysqli_num_rows($get_data)>0){
                                            while ($vr=mysqli_fetch_assoc($get_data)){
                                                ?>
                                                <div class="row" style="font-size: 13px;">
                                                    <div class="col-md-3">
                                                        <img src="<?=$vr['photo']?>" alt="" class="rounded-circle float-left bg-gradient-secondary mx-2" width="60" height="60" >
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h6><a  class="text-wrap text-decoration-none "><?=$vr['fname']." ".$vr['lname']?><span><?php
                                                                    if ($vr['user_type']=="1"){
                                                                        echo " | Admin";
                                                                    }elseif ($vr['user_type']=="3"){
                                                                        echo " | Collector";
                                                                    }?></span></a></h6>
                                                        <p class="text-wrap">
                                                            <?php
                                                            $mes= base64_decode($vr['b_message']);
                                                            $length=50;

                                                            if (strlen($mes) > $length) {
                                                                $trimmedMessage = substr($mes, 0, $length) . " ....";
                                                            } else {
                                                                $trimmedMessage = $mes;
                                                            }
                                                            echo $trimmedMessage;
                                                            ?>
                                                            <br>
                                                            <?=date('M d',strtotime($vr['b_posted_date']))." at ".date('H:i',strtotime($vr['b_posted_date']))?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }else{
                                            echo '
                                           <div class="alert alert-primary text-center" role="alert">
                                                 No Updates yet.
                                            </div>
                                           ';
                                        }
                                        ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                                            <button class="nav-link bg-transparent border-0" type="submit" name="bulletin">
                                                <span class="text-primary">See more...</span>
                                                <?php
                                                $show= mysqli_query($con,"SELECT * FROM `tbl_bulletin_viewer` where v_user_id='".$_SESSION['user_id']."' and v_status='0'");
                                                if (mysqli_num_rows($show)>0){
                                                    echo ' <span class="badge bg-danger mx-3 ">'.mysqli_num_rows($show).'</span>';
                                                }else{
                                                    echo "";
                                                }
                                                ?>
                                            </button>
                                        </form>
                                    </div><!-- End News & Updates -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Analytical Data
                    </div>
                    <hr>
                    <div class="row" id="most">
                        <div class="bg-white text-center col-md-12">
                            <p class="mt-4">Select Date Range:</p>
                            <form action="" method="post">
                                <label for="from_date">From:</label>
                                <input type="date" name="from" required>
                                <label for="to_date">To:</label>
                                <input type="date" name="to" required>
                                <button type="submit" name="show">Show</button>
                            </form>
                            <?php
                            if (isset($_POST['show'])){
                                $from=$_POST['from'];
                                $to=$_POST['to'];
                                echo '<script>window.open("dashboard.php#most","_self")</script>';
                                ?>
                                <p class="mt-2">Month of <span style="font-weight: bold"><?=date("Y F d",strtotime($from))?></span> to <span style="font-weight: bold"><?=date("Y F d",strtotime($to))?></span></p>
                                <?php
                            }else{
                                $from=date("y-m-d",strtotime("-1 month"));
                                $to=date('y-m-d');
                                echo '<script>window.open("dashboard.php#most","_self")</script>';
                                ?>
                                <p class="mt-2">Month of <span style="font-weight: bold"><?=date("Y F d",strtotime($from))?></span> to <span style="font-weight: bold"><?=date("Y F d",strtotime($to))?></span></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div id="chart_div9" style="height: 400px;" class="col-md-12"></div>
                    </div>
                    <div class="row mt-2"></div>
                    <div class="row">
                        <div id="chart_div8"  style="height: 300px" class="col-md-12"></div>
                    </div>
                    <div class="row mt-2"></div>
                    <!-- 3rd Content Row -->
                    <div class="row">
                        <div id="chart_div1" style="width: 500px; height: 500px;" class="col-md-6"></div>
                        <div id="chart_div2" style="width: 500px; height: 500px;" class="col-md-6"></div>
                        <div id="chart_div3" style="width: 500px; height: 500px;" class="col-md-6"></div>
                        <div id="chart_div4" style="width: 500px; height: 500px;" class="col-md-6"></div>
                        <div id="chart_div5" style="width: 500px; height: 500px;" class="col-md-6"></div>
                        <div id="chart_div7" style="width: 500px; height: 500px;" class="col-md-6"></div>
                    </div>
                    <div class="row mt-2">
                    <div class="col-md-6" >
                            <div class="bg-white text-center">
                                <p>Select Date Range:</p>
                                <label for="from_date">From:</label>
                                <input type="date" id="from_date" required>
                                <label for="to_date">To:</label>
                                <input type="date" id="to_date" required>
                                <button onclick="getChartData()">Get Chart</button>
                            </div>
                            <span id="chart_div6"  style="height: 400px;"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="chart_div10" style="width: 600px; height: 400px;"></div>
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

        </div>
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
if (isset($_POST['bulletin'])){
$id=$_POST['user_id'];
$go=mysqli_query($con,"SELECT * FROM `tbl_bulletin_viewer` where v_user_id='$id' and v_status='0'");
if (!$go){
    die("Query failed: ".mysqli_error($con));
}
if (mysqli_num_rows($go)>0){
$update=mysqli_query($con,"UPDATE `tbl_bulletin_viewer` SET `v_status` = '1' WHERE `tbl_bulletin_viewer`.`v_user_id` = '$id'");
if ($update===true){
echo '<script>window.open("bulletin.php","_self")</script>';
}
}else{
echo '<script>
    var result = confirm("No latest update. Do you want to continue?");

    if (result) {
        window.open("bulletin.php","_self");
    } else {

    }
</script>';
}
}
?>
