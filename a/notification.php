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
                    window.open("notification.php","_self");
                }
            </script>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Notification<span class="ml-2"><button type="button" class="btn btn-primary bnt-sm" onclick="reload()">Reload</button></span></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notification</li>
                    </ol>
                </nav>
            </div>

            <div class="card-body">

                <?php
                $get_notif=mysqli_query($con,"select tbl_user.*, tbl_notification.*  from tbl_notification inner join tbl_user on tbl_notification.user_id=tbl_user.user_id order by notif_date DESC");
                if (mysqli_num_rows($get_notif)>0){
                    while($gf=mysqli_fetch_assoc($get_notif)){
                        ?>
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <?=date("D d M, Y h:i:s A",strtotime($gf['notif_date']))?>
                                        </div>
                                        <div class="h6 mb-0 text-gray-800 text-justify mx-2">
                                            <?=ucwords($gf['fname']." ".$gf['lname'])." has a low ratings which is <span class='text-danger'>".number_format($gf['notif_rating'],2)."</span> %."?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-2"></div>
                        <?php
                    }
                }
                ?>

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
