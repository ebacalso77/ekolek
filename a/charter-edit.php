<?php
include "header.php";
include "../connection.php";
if (isset($_GET['id'])){
    $get_data=mysqli_query($con,"select * from tblcitizencharter where cc_id='".$_GET['id']."'");
    if (mysqli_num_rows($get_data)>0){
        $row=mysqli_fetch_assoc($get_data);
    }
}
if (isset($_POST['save_data'])) {
    $fs = $_POST['fs'];
    $procedure = $_POST['procedure'];
    $time = $_POST['time'];
    $rp = $_POST['rp'];
    $req = $_POST['req'];
    $output = $_POST['output'];

    $save = mysqli_query($con, "UPDATE `tblcitizencharter` SET `frontline_service` = '$fs', `cc_procedure` = ' $procedure', `time` = '$time', `responsible_person` = '$rp', `requirements` = '$req', `output` = '$output' WHERE `tblcitizencharter`.`cc_id` = '" . $_GET['id'] . "'");
    if ($save) {
        echo '<script>alert("Data Updated successful.");window.open("charter.php","_self");</script>';
    }
}

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
                <h1 class="h3 mb-0 text-gray-800">Citizen Charter</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Citizen Charter</li>
                    </ol>
                </nav>
            </div>
            <div class="card mx-lg-5 my-3">
                <div class="card-body">
                    <h5 class="card-title">Update Details</h5>
                    <hr>
                    <form method="post"  style="font-size: 12px" class="mx-5" >
                        <div class="form-group">
                            <h6><strong>Frontline Service</strong></h6>
                            <input type="text" name="fs"  class="form-control" autofocus required value="<?=$row['frontline_service']?>">
                        </div>
                        <div class="form-group">
                            <h6><strong>Procedure</strong></h6>
                            <textarea class="form-control" name="procedure" id="" cols="10" rows="3"><?=$row['cc_procedure']?></textarea>
                        </div>
                        <div class="form-group" >
                            <h6><strong>Time</strong></h6>
                            <textarea class="form-control" name="time" id="" cols="10" rows="3"><?=$row['time']?></textarea>
                        </div>
                        <div class="form-group">
                            <h6><strong>Responsible Person</strong></h6>
                            <input type="text" name="rp"  class="form-control"  required value="<?=$row['responsible_person']?>">
                        </div>
                        <div class="form-group">
                            <h6><strong>Requirements</strong></h6>
                            <input type="text" name="req"  class="form-control"  required value="<?=$row['requirements']?>">
                        </div>
                        <div class="form-group">
                            <h6><strong>Output</strong></h6>
                            <input type="text" name="output"  class="form-control"  required value="<?=$row['output']?>">
                        </div>
                        <div class="float-right">
                            <a href="charter.php" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary " name="save_data">Submit</button>
                        </div>

                    </form>
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
