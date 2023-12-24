<?php
include "header.php";
include "../connection.php";
if (isset($_POST['ans'])) {
    $r_id=$_POST['r_id'];
    $up = mysqli_query($con, "UPDATE `tbl_request` SET `r_status` = 'approved' WHERE `tbl_request`.`r_id` = '$r_id'");
    if ($up === true) {
        echo '<script>window.open("request.php","_self");</script>';
    }
}
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
                    <h1 class="h3 mb-0 text-gray-800">Request List<span class="ml-2"><button type="button" class="btn btn-primary bnt-sm" onclick="reload()">Reload</button></span></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Request</li>
                        </ol>
                    </nav>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <tfoot>
                            <tr>
                                <th class="text-wrap">#</th>
                                <th>Date Posted</th>
                                <th>Requester</th>
                                <th>Request</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            $request=mysqli_query($con," SELECT tbl_user.*,tbl_request.* FROM `tbl_request`inner join tbl_user on tbl_request.r_user_id=tbl_user.user_id order by date_posted DESC");
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
                                        <td class="text-wrap text-center">
                                            <?php
                                            if ($r['r_status']=="pending"){
                                                echo '<span class="text-secondary" style="font-size: 30px"><i class="fa fa-clock" title="On-Process"></i></span><br><small>Waiting for Approval</small>';
                                            }elseif ($r['r_status']=="approved"){
                                                echo '<span class="text-secondary" style="font-size: 30px"><i class="fa fa-thumbs-up" title="Approved"></i></span><br><small>Approved By Me.</small>';
                                            }
                                            elseif ($r['r_status'] == "on-process") {
                                                echo '<span class="text-primary" style="font-size: 30px"><i class="fa fa-users-cog" title="On-Process"></i></span><br><small>On-Process</small>';
                                            } elseif ($r['r_status'] == "done") {
                                                echo '<span class="text-success" style="font-size: 30px"><i class="fa fa-check-circle" title="Done"></i></span>';
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($r['r_status']=="pending"){
                                               ?>
                                                <form action="" method="post">
                                                    <input type="hidden" name="r_id" value="<?=$r['r_id']?>">
                                                    <br><button type="submit" name="ans" class="btn-primary btn btn-sm">Approved</button>
                                                </form>
                                               <?php
                                            }else{
                                                echo "-";
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