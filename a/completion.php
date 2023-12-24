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
                    window.open("completion.php","_self");
                }
            </script>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Collector Completion List<span class="ml-2"><button type="button" class="btn btn-primary bnt-sm" onclick="reload()">Reload</button></span></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Collector Completion</li>
                    </ol>
                </nav>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-wrap">Collector</th>
                            <th>Total Truck</th>
                            <th>Brgy. Collected</th>
                            <th>Date Collection</th>
                            <th>Transferred Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $completion=mysqli_query($con,"SELECT tbl_user.* , tbl_collection_completion_report.* FROM tbl_collection_completion_report inner JOIN tbl_user on tbl_collection_completion_report.ccr_user_id=tbl_user.user_id order by ccr_id DESC");
                        if (mysqli_num_rows($completion)>0){
                            while ($comp=mysqli_fetch_assoc($completion)){
                                ?>
                                <tr>
                                    <td><?=ucwords($comp['fname']." ".$comp['lname'])?></td>
                                    <td><?=$comp['ccr_total_truck']?></td>
                                    <td>
                                        <?php
                                        $sel_brgy=mysqli_query($con,"SELECT * FROM `baranggay` where m_id='".$_SESSION['user_m_id']."' ");
                                        if (mysqli_num_rows($sel_brgy)>0){
                                            while($b=mysqli_fetch_assoc($sel_brgy)){
                                                if ($comp['ccr_brgy'] == $b['b_id']) {
                                                    echo ucwords($b['b_name']);
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?=date("d M Y",strtotime($comp['ccr_date_collection']))?></td>
                                    <td>
                                        <?php
                                        if($comp['ccr_date_transferred']==NULL){
                                            echo "";
                                        }else {
                                            echo date("d M,Y", strtotime($comp['ccr_date_transferred']))." at ".date("h:i A",strtotime($comp['ccr_date_transferred']));
                                        }
                                        ?>
                                    </td>
                                <td>
                                    <?php
                                    if ($comp['ccr_status']=="done" or $comp['ccr_status']=="transferred"){
                                        echo '<span class="badge badge-success">'.ucwords($comp['ccr_status']).'</span>';
                                    }elseif ($comp['ccr_status']=="on-process" or $comp['ccr_status']=="collected"){
                                        echo '<span class="badge badge-secondary">'.ucwords($comp['ccr_status']).'</span>';
                                    }elseif ($comp['ccr_status']=="on the way"){
                                        echo '<span class="badge badge-info">'.ucwords($comp['ccr_status']).'</span>';
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
<script>
    $(document).ready(function() {
        $('#dataTable2').DataTable();
    });

</script>
<?php
include "footer.php";
?>
