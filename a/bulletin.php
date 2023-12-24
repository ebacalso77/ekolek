<?php
include "header.php";
?>
    <body id="page-top" onload="startTime()">
    <?php
    if (isset($_POST['send'])){
        $comment=$_POST['comment'];
        $name_id=$_SESSION['user_id'];
        $id=$_POST['u_id'];

        $insert=mysqli_query($con,"INSERT INTO `tbl_bulletin_comment` ( `bc_comment_by`, `bc_comment`, `bc_timestamp`, `bc_bulletin_id`) VALUES ( '$name_id','$comment', current_timestamp(), '$id')");
        if ($insert===true){
            echo '<script>window.open("bulletin.php#'.$id.'","_self")</script>';
        }
    }
    ?>
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
                        <div id="clock" style="font-weight: bold; color:#1f1919;font-family:" Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol""></div>
            <div id="date" style="color: #0c0808" class="mx-2"> | <?php echo date('l, F j, Y'); ?></div>
            </ul>


            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <script>
                    function Click() {
                        document.getElementById("Reload").addEventListener("click", function () {
                            window.open("bulletin.php", "_self");
                        });
                    }
                </script>
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Bulletin Board <span><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#bulletin"><i class="fa fa-plus"></i> New</button></span><br><a href="" class="btn btn-secondary btn-sm float-left" id="Reload">Reload</a></h1>
                    <?php
                    if (isset($_POST['post'])) {
                        $user = $_POST['user_id'];
                        $desc = $_POST['desc'];
                        $file = $_FILES['file'];
                        // File properties
                        $fileName = $file['name'];
                        $fileTmp = $file['tmp_name'];
                        $uploadPath = "../upload/" . $fileName;

                        $enc_mes = base64_encode($desc);

                        $SelectUserAccount=mysqli_query($con,"SELECT * FROM tbl_user ");
                        if (mysqli_num_rows($SelectUserAccount)>0){
                            $insert = mysqli_query($con, "INSERT INTO `tbl_bulletin` ( `posted_by`, `b_message`, `b_photo`, `b_posted_date`) VALUES ( '".$_SESSION['user_id']."', '$enc_mes', '$uploadPath', current_timestamp())");
                           $lastId=mysqli_insert_id($con);
                            if ($insert === true) {
                                move_uploaded_file($fileTmp, $uploadPath);
                            }
                            while ($sua=mysqli_fetch_assoc($SelectUserAccount)) {
                                if($sua['user_type']==1){
                                    mysqli_query($con, "INSERT INTO `tbl_bulletin_viewer` ( `v_b_id`, `v_user_id`,v_status) VALUES ( '$lastId','".$sua['user_id']."','1')");
                                }else {
                                    mysqli_query($con, "INSERT INTO `tbl_bulletin_viewer` ( `v_b_id`, `v_user_id`,v_status) VALUES ( '$lastId','".$sua['user_id']."','0')");
                                }
                            }echo '<script>alert("Announcement is posted.");window.open("bulletin.php","_self")</script>';
                        }else{
                            echo '<script>alert("You have no registered user.")</script>';
                        }
                    }
                    ?>
                    <!-- Modal Bulletin -->
                    <div class="modal fade" id="bulletin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-center" id="exampleModalLabel">New Announcement</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post"  style="font-size: 12px" enctype="multipart/form-data">
                                        <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
                                        <div class="form-group">
                                            <h6><span class="text-danger">*</span>What's on your mind?</h6>
                                            <textarea class="form-control" name="desc" id="" cols="70" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <h6><span class="text-danger">*</span>Add Photo</h6>
                                            <input type="file" accept=".jpg,.jpeg,.png" class="form-control "  placeholder="Upload Photo" name="file" title="Upload Photo" >
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm" name="post">Post</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bulletin Board</li>
                        </ol>
                    </nav>
                </div>

                <div class="row">
                    <?php
                    $get_data=mysqli_query($con,"
                   SELECT
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
ORDER BY tbl_bulletin.b_posted_date DESC;
");
                    if(!$get_data){
                        die("Query failed: ". mysqli_error($con));
                    }
                    if (mysqli_num_rows($get_data)>0){
                        $i=0;
                        while ($b=mysqli_fetch_assoc($get_data)){
                            $if="if-".$i;
                            $id="id-".$i;
                            $ic="ic-".$i;
                            $ie="ie-".$i;
                            $i++;
                                ?>
                                <!-- post-->
                                <div class="col-4 mb-4" id="<?=$b['b_id']?>">
                                    <div class="card border-left-primary shadow h-100 py-1">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="p font-weight-bold text-primary">
                                                      <?php
                                                      echo ucfirst($b['fname']." ".$b['mname']." ".$b['lname']);
                                                        ?>
                                                        |<small class="mx-1">
                                                            <?php
                                                            if ($b['user_type']==="1"){
                                                                echo "Admin";
                                                            }elseif($b['user_type']==="3"){
                                                                echo "Collector";
                                                            }
                                                            ?>
                                                        </small></div>
                                                    <div class="p font-weight-bold text-gray "><?=$b['time_difference']?> .<i class="fa fa-globe-asia mx-1"></i></div>
                                                </div>
                                                <div class="row mx-1 my-1">
                                                    <p class="text-wrap text-justify" style="font-size: 15px"><?=base64_decode($b['b_message'])?>
                                                        <?php
                                                        if ($b['user_type']=="3"){
                                                            ?>
                                                        <br><span class="text-dark" style="font-size: 13px;">Schedule Collection Details: <strong><?=date("D d M, Y",strtotime($b['date_pass']))?> Around <?=date("h:i:s A",strtotime($b['time_from']))?> to <?=date("h:i:s A",strtotime($b['time_to']))?> at Brgy.
                                                            <?php
                                                            $get_brgy=mysqli_query($con,"SELECT * FROM `baranggay` where b_id ='".$b['brgy']."'");
                                                            if (mysqli_num_rows($get_brgy)>0){
                                                                $gb=mysqli_fetch_assoc($get_brgy);
                                                                echo  ucwords($gb['b_name']);
                                                            }
                                                            ?>
                                                        </strong></span>
                                                            <?php
                                                        }
                                                            ?>
                                                    </p>
                                                    <?php
                                                    if ($b['b_photo']=="../upload/"){
                                                        ?>
                                                        <a href="" data-toggle="modal" data-target="#<?=$id?>"><img src="../img/default.png" alt="" class="img-thumbnail" width="auto" height="auto"></a>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <img src="../img/default.png" alt="" class="img-thumbnail w-100 h-75">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <a href=""  data-toggle="modal" data-target="#<?=$id?>"><img src="<?=$b['b_photo']?>" alt="" class="img-thumbnail" width="auto" height="auto"></a>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <img src="<?=$b['b_photo']?>" alt="" class="img-thumbnail w-100 h-75">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <small class="mt-1 mx-1">
                                                    <button class="btn btn-sm border-0 font-weight-bold text-primary"  data-toggle="modal" data-target="#<?=$ic?>">
                                                        <?php
                                                        $get_count=mysqli_query($con,"select * from tbl_bulletin_comment where bc_bulletin_id='".$b['b_id']."'");
                                                        if (mysqli_num_rows($get_count)>0){
                                                            echo mysqli_num_rows($get_count);
                                                        }else{
                                                            echo "0";
                                                        }
                                                        ?>
                                                        comments
                                                    </button>|
                                                    <!-- show comment Modal -->
                                                    <div class="modal fade" id="<?=$ic?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content ">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title" id="exampleModalLabel">Most relevant</h6>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    $get_comment=mysqli_query($con,"select tbl_bulletin_comment.*,tbl_user.*, CASE
        WHEN bc_timestamp > NOW() - INTERVAL 1 MINUTE THEN 'Just now'
        WHEN bc_timestamp > NOW() - INTERVAL 1 HOUR THEN CONCAT(TIMESTAMPDIFF(MINUTE, bc_timestamp, NOW()), ' minutes ago')
        WHEN bc_timestamp > NOW() - INTERVAL 1 DAY THEN CONCAT(TIMESTAMPDIFF(HOUR, bc_timestamp, NOW()), ' hours ago')
        WHEN bc_timestamp > NOW() - INTERVAL 1 MONTH THEN CONCAT(TIMESTAMPDIFF(DAY, bc_timestamp, NOW()), ' days ago')
        WHEN bc_timestamp > NOW() - INTERVAL 1 YEAR THEN CONCAT(TIMESTAMPDIFF(MONTH,bc_timestamp, NOW()), ' months ago')
        ELSE CONCAT(TIMESTAMPDIFF(YEAR, bc_timestamp, NOW()), ' years ago')
    END AS time_diff from tbl_bulletin_comment left join tbl_user on tbl_bulletin_comment.bc_comment_by=tbl_user.user_id where bc_bulletin_id='".$b['b_id']."' order by bc_timestamp DESC;");
                                                                    if(!$get_comment){
                                                                        die("Query failed: ".mysqli_error($con));
                                                                    }
                                                                    if (mysqli_num_rows($get_comment)>0){
                                                                        while ($gc=mysqli_fetch_assoc($get_comment)){
                                                                            ?>
                                                                            <div class="col-md-3">
                                                                                <img src="<?=$gc['photo']?>" alt="" class="rounded-circle float-left bg-gradient-secondary mx-2 mr-1" width="60" height="60" >
                                                                            </div>
                                                                            <div class="col-md-9 mx-1">
                                                                                <b><?=$gc['fname']." ".$gc['lname']?></b><br>
                                                                                <p><?=ucwords($gc['bc_comment'])?>
                                                                                    <br>
                                                                                    <small><?=$gc['time_diff']?></small></p>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }else{
                                                                        echo '<div class="alert alert-info text-center col-9 container my-2" role="alert">
                                                                                                  Comment list is Empty. 
                                                                                                    </div>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <i>
                                                        <div class="btn-group dropup">
                                                            <button class="btn btn-sm border-0 font-weight-bold text-primary" type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <?php
                                                                $total_view = mysqli_query($con, "SELECT COUNT(*)as total_view from tbl_bulletin_viewer WHERE v_status='1'and v_b_id='".$b['b_id']."' ");

                                                                if (mysqli_num_rows($total_view) > 0) {
                                                                    $tv=mysqli_fetch_assoc($total_view);
                                                                    echo $tv['total_view'];
                                                                } else {
                                                                    echo "0";
                                                                }
                                                                ?> views
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <?php
                                                                $Get_User=mysqli_query($con,"SELECT tbl_user.*,tbl_bulletin_viewer.* from tbl_bulletin_viewer inner join tbl_user on tbl_bulletin_viewer.v_user_id=tbl_user.user_id where tbl_bulletin_viewer.v_status='1' and tbl_bulletin_viewer.v_b_id ='".$b['b_id']."' ORDER by tbl_bulletin_viewer.v_user_id DESC;");
                                                                if (mysqli_num_rows($Get_User)>0){
                                                                    while ($v=mysqli_fetch_assoc($Get_User)){
                                                                        ?>
                                                                        <li><img src="<?=$v['photo']?>" alt="user" class="rounded-circle h-25 w-25 mx-1"><?=ucfirst($v['fname']." ".$v['lname'])?></li>
                                                                        <?php
                                                                    }
                                                                }else {
                                                                    echo '0 views.';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div></i>|  Posted Date: <?=date("M d,Y",strtotime($b['b_posted_date']))." at ".date("H:i:s",strtotime($b['b_posted_date']))?></small>
                                            </div>
                                            <div class="row col-md-12 mx-1">
                                                <form action="" method="post" class="w-100">
                                                    <div class="input-group input-group-sm mb-3">
                                                        <input type="hidden" name="u_id" value="<?=$b['b_id']?>">
                                                        <input type="text" class="form-control" style="width: auto" placeholder="Comment" aria-label="Recipient's username" aria-describedby="button-addon2" required name="comment">
                                                        <button class="btn btn-outline-secondary btn-sm" type="submit" id="button-addon2" name="send"><i class="fa fa-paper-plane"></i> </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end  post-->
                                <?php
                        }
                    }
                        else{
                        echo '<div class="alert alert-info text-center col-9 h5 py-4 container my-5" role="alert">
                              Bulletin Board is Empty. 
                                </div>';
                        }
                    ?>

                    <!-- Scroll to Top Button-->
                    <a class="scroll-to-top rounded position-fixed text-center" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>
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
?>