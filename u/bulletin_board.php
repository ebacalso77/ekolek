<?php
include "../connection.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Main | E-Kolek</title>

    <!-- Custom fonts for this template-->

    <link href=".././vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href=".././css/admin-2.min.css" rel="stylesheet">
    <link rel="icon" href=".././img/recycle.png">
    <script src="../a/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<?php
if (isset($_POST['send'])){
    $comment=$_POST['comment'];
    $name_id=$_SESSION['user_id'];
    $id=$_POST['u_id'];

    $insert=mysqli_query($con,"INSERT INTO `tbl_bulletin_comment` ( `bc_comment_by`, `bc_comment`, `bc_timestamp`, `bc_bulletin_id`) VALUES ( '$name_id','$comment', current_timestamp(), '$id')");
    if ($insert===true){
        echo '<script>window.open("bulletin_board.php#'.$id.'","_self")</script>';
    }
}
?>
<body class="bg-gradient-success">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-1" id="page-top">

        <div class="col-12">
            <div class="card o-hidden border-0 shadow-lg my-3" >
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12" >
                            <br>
                            <div class="p-4">
                                <div class="float-right dragstart" style="font-size: 20px">
                                    <a href="" type="button" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-fw fa-cog"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                                <div class="text-left" >
                                    <a class="text-decoration-none text-dark" href="user_main.php" title="Main Menu"><i class="fa fa-arrow-left fa-lg"></i></a>
                                </div>
                                <div class="float-left ml-2">
                                    <img src="../img/recycle.png" alt=""  class="img-thumbnail mx-2" width="40" height="40">
                                </div>
                                <div class="text-left">
                                    <h1 class="h4 text-gray-900 mb-3" style="font-size: 30px;font-weight: bolder;">E-Kolek</h1>
                                </div>
                                <div class="text-center my-3">
                                    <h4 class="text-gray-900 " style="font-weight: bolder;">Bulletin Board</h4>
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
INNER JOIN tbl_user ON tbl_bulletin.posted_by = tbl_user.user_id  where brgy='".$_SESSION['brgy']."' or user_type='1'
ORDER BY tbl_bulletin.b_posted_date DESC;
");
                                    if (mysqli_num_rows($get_data)>0){
                                        $i=0;
                                        while ($b=mysqli_fetch_assoc($get_data)){
                                            $if="if-".$i;
                                            $id="id-".$i;
                                            $ic="ic-".$i;
                                            $ie="ie-".$i;
                                            $i++;
                                            ?>
                                                <!--  post-->
                                                <div class="col-12 mb-4" id="<?=$b['b_id']?>">
                                                    <div class="card border-left-success shadow h-100 py-1">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="p font-weight-bold text-primary">
                                                                        <?=ucfirst($b['fname']." ".$b['mname']." ".$b['lname'])?> |<small class="mx-1">
                                                                            <?php
                                                                            if ($b['user_type']=="1"){
                                                                                echo "Admin";
                                                                            }else{
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
                                                                                $get_brgy=mysqli_query($con,"SELECT * FROM `baranggay` where b_id ='".$b['b_brgy_id']."'");
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
    END AS time_diff from tbl_bulletin_comment inner join tbl_user on tbl_bulletin_comment.bc_comment_by=tbl_user.user_id where bc_bulletin_id='".$b['b_id']."' order by bc_timestamp DESC");
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
                                                                        <i> <div class="btn-group dropup">
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
                                                                            </div></i>| Posted Date: <?=date("M d,Y",strtotime($b['b_posted_date']))." at ".date("H:i:s",strtotime($b['b_posted_date']))?></small>
                                                                </div>
                                                                <div class="row mx-1">
                                                                    <form action="" method="post">
                                                                        <div class="input-group input-group-sm mb-3 ">
                                                                            <input type="hidden" name="u_id" value="<?=$b['b_id']?>">
                                                                            <input type="text" class="form-control" placeholder="Comment" aria-label="Recipient's username" aria-describedby="button-addon2" required name="comment">
                                                                            <button class="btn btn-outline-secondary btn-sm" type="submit" id="button-addon2" name="send"><i class="fa fa-paper-plane"></i> </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end post-->
                                                <?php
                                        }
                                    }else{
                                        echo '<div class="alert alert-info text-center col-9 py-4 container my-2" role="alert">
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

</body>

</html>
