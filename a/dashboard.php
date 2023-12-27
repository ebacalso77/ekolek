<?php
include "header.php";
include "../connection.php";
?>
<body id="page-top" onload="startTime();c();">

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
                <!-- 1st Content Row -->
                <div class="row">
                    <!-- Left side (size 8) -->
                    <div class="col-xl-8">
                        <div class="row">
                            <!-- Total User -->
                            <div class="col-xl-3 col-md-6 mb-2">
                                <a href="user.php" class="text-decoration-none">
                                    <div class="card border-secondary border-left-primary shadow h-70">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Users
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                        $user = mysqli_query($con, "select * from tbl_user where user_type=2");
                                                        if (mysqli_num_rows($user) > 0) {
                                                            echo mysqli_num_rows($user);
                                                        } else {
                                                            echo "0";
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-blue-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Collector  -->
                            <div class="col-xl-3 col-md-6 mb-2 ">
                                <a href="collector.php" class="text-decoration-none">
                                    <div class="card border-secondary border-left-warning shadow  h-70">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                        Collector</div>
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
                                                    <i class="fas fa-truck fa-2x text-warning"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Total complaint-->
                            <div class="col-xl-3 col-md-6 mb-2 ">
                                <a href="complaint.php" class="text-decoration-none" >
                                    <div class="card border-secondary border-left-success shadow  h-70">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Complaint</div>
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
                                                    <i class="fas fa-chart-pie fa-2x text-success"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Total request-->
                            <div class="col-xl-3 col-md-6 mb-2 ">
                                <a href="request.php" class="text-decoration-none">
                                    <div class="card border-secondary border-left-info shadow  h-70">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Request
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
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-info"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="card p-0 mb-1 border-secondary shadow mb-2">
                            <div class="card-body " id="weekly_d">
                                <div id="chart_div8" style="height: 300px;"></div>
                                <a id="weekly" href="add-weekly-total-collected-waste.php"  class="btn btn-primary btn-sm" ><i class="fa fa-eye mx-2"></i>Weekly Total Collected Waste per Brgy </a>
                            </div>
                        </div>
                        <div class="card p-0 mb-1 border-secondary shadow mb-2">
                            <div class="card-body border-dark">
                                <div class="text-center">
                                <p class="mt-4">Select Date Range:</p>
                                <form action="" method="post">
                                    <label for="from_date">From:</label>
                                    <input type="date" name="from" required>
                                    <label for="to_date">To:</label>
                                    <input type="date" name="to" required>
                                    <button type="submit" name="show">Show</button>
                                </form>
                                </div>
                                <div id="chart_div9" style="height: 300px;"></div>
                                <a href="" data-toggle="modal" data-target="#common" class="btn btn-primary btn-sm" ><i class="fa fa-eye mx-2"></i>Most Common Complaint</a>
                                <!-- Modal -->
                                <div class="modal fade" id="common" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title fs-5 text-center font-weight-bold" id="exampleModalLabel">Most Common Complaint</h6>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="mx-2">
                                                        <?php
                                                        $view_report =mysqli_query($con," SELECT message, COUNT(tbl_report.message) AS count_mes
                                    FROM tbl_report 
                                    GROUP BY tbl_report.message
                                    ORDER BY count_mes DESC
                                    LIMIT 6;
                                    ");

                                                        // Check for query execution error
                                                        if (!$view_report) {
                                                            die("Query failed: " . mysqli_error($con));
                                                        }
                                                        if (mysqli_num_rows($view_report)>0){
                                                            while ($vr=mysqli_fetch_assoc($view_report)){
                                                                ?>
                                                                <div class="row" style="font-size: 13px;">
                                                                    <div class="col-md-12">
                                                                        <p class="">
                                                                            <?php
                                                                            echo ucfirst($vr['message']);
                                                                            ?>
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
                                                        <a href="complaint.php" class="text-decoration-none"><small>See more....</small></a>
                                                    </div><!-- End News & Updates -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card p-0 mb-1 border-secondary shadow">
                            <div class="card-body">
                                <div id="chart_div10" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Right side (size 4) -->
                    <div class="col-xl-4">
                        <div id="chart_div2" class="border border-secondary  rounded p-2 mb-2 shadow" >
                            <canvas id="chart_div2" ></canvas>
                        </div>
                        <div id="chart_div4" class="border border-secondary rounded p-2 mb-2 shadow ">
                            <canvas id="chart_div4"></canvas>
                        </div>
                        <div id="chart_div3" class="border border-secondary rounded p-2 mb-2 shadow">
                            <canvas id="chart_div3"></canvas>
                        </div>
                        <div id="chart_div7" class="border border-secondary rounded p-2 mb-2 shadow">
                            <canvas id="chart_div7"></canvas>
                        </div>
                        <div id="chart_div1" class="border border-secondary rounded p-2 mb-2 shadow">
                            <canvas id="chart_div1"></canvas>
                        </div>
                        <div id="chart_div5" class="border border-secondary rounded p-2 shadow">
                            <canvas id="chart_div5"></canvas>
                        </div>
                    </div>
                </div>
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
