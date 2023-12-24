<?php
include "header.php";
include "../connection.php";
$check = mysqli_query($con, "SELECT collectors_id, SUM(ratings_no) / COUNT(collectors_id) AS average_rating
FROM tbl_collector_satisfactory_rating
GROUP BY collectors_id, ratings_no;
");
if (mysqli_num_rows($check) > 0) {
    while ($col = mysqli_fetch_assoc($check)) {
        if ($col['average_rating'] < 75) {
            $me = "You have an average rating of " . $col['average_rating'] . ". Please be mindful of this.";

            // Check if a notification for today already exists
            $check_notif = mysqli_query($con, "SELECT * FROM tbl_notification WHERE user_id = '" . $col['collectors_id'] . "' AND DATE(notif_date) = CURDATE()");

            if (mysqli_num_rows($check_notif) == 0) {
                mysqli_query($con, "INSERT INTO `tbl_notification` ( `user_id`, notif_rating,`notif_message`, `notif_date`, `notif_view`) VALUES ( '" . $col['collectors_id'] . "','".$col['average_rating']."', '$me', current_timestamp(), '0')");
            }
        }
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
                    window.open("weekly_satisfaction.php","_self");
                }
            </script>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Weekly Satisfaction Review Collection<span class="ml-2"><button type="button" class="btn btn-primary bnt-sm" onclick="reload()">Reload</button></span></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Weekly Satisfaction Review Collection</li>
                    </ol>
                </nav>
            </div>

            <div class="card-body">
                <?php
                if (isset($_POST['enableForm'])){
                    $update=mysqli_query($con,"UPDATE `form_stats` SET `status` = '1' WHERE `form_stats`.`s_id` = 1");
                    if ($update==true){
                        echo '<script>alert("Form is enable.");window.open("weekly_satisfaction.php","_self");</script>';
                    }
                }
                if (isset($_POST['disableForm'])){
                    $update=mysqli_query($con,"UPDATE `form_stats` SET `status` = '0' WHERE `form_stats`.`s_id` = 1");
                    if ($update==true){
                        echo '<script>alert("Form is Disable now.");window.open("weekly_satisfaction.php","_self");</script>';
                    }
                }
                ?>
                <form action="" method="post">
                    <button class="btn btn-primary btn-sm mb-2" type="submit"  name="enableForm">Enable Survey Form</button>
                    <button class="btn btn-danger btn-sm mb-2 " type="submit" name="disableForm">Disable Survey Form</button>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-wrap">Collector's Name</th>
                            <th>Ratings (%) as of <span class="mx-1"><?=date('d F, Y')?></span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $select_col_rate=mysqli_query($con,"SELECT collectors_id, SUM(ratings_no)/ COUNT(collectors_id) AS average_rating FROM `tbl_collector_satisfactory_rating` inner join tbl_user on tbl_collector_satisfactory_rating.collectors_id=tbl_user.user_id GROUP BY collectors_id ");
                        if(!$select_col_rate){
                            die("Query failed: ".mysqli_error($con));
                        }
                        if (mysqli_num_rows($select_col_rate)>0){
                            while ($sc=mysqli_fetch_assoc($select_col_rate)){
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        $get_name=mysqli_query($con,"select * from tbl_user where user_id='".$sc['collectors_id']."'");
                                        if (mysqli_num_rows($get_name)>0){
                                            $n=mysqli_fetch_assoc($get_name);
                                            echo ucwords($n['fname']." ".$n['mname']." ".$n['lname']);
                                        }
                                        ?>
                                    </td>
                                    <td><?=number_format($sc['average_rating'],2)?></td>
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
