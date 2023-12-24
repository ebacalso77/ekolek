<?php
include "header.php";
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
                        <div id="clock" style="font-weight: bold; color:#1f1919;font-family:" Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol""></div>
            <div id="date" style="color: #0c0808" class="mx-2"> | <?php echo date('l, F j, Y'); ?></div>
            </ul>


            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Account Setting</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 text-primary font-weight-bold">Profile
                        <?php
                        if (isset($_POST['update'])){
                            $user=$_POST['user_id'];
                            $fname=$_POST['fname'];
                            $mname=$_POST['mname'];
                            $lname=$_POST['lname'];
                            $email=$_POST['email'];
                            $username=$_POST['username'];
                            $pass=$_POST['pass'];
                            $cpass=$_POST['cpass'];
                            $municipality=$_POST['municipality'];
                            $brgy=$_POST['brgy'];
                            $status=$_POST['status'];
                            $phone=$_POST['phone'];

                            $encrypPass=sha1($pass);

                            $file = $_FILES['file'];
                            // File properties
                            $fileName = $file['name'];
                            $fileTmp = $file['tmp_name'];
                            $uploadPath = "../upload/" . $fileName;

                            $update=mysqli_query($con,"UPDATE `tbl_user` SET `accnt_status` = '$status', `username` = '$username', `email` = '$email', `fname` = '$fname', `mname` = '$mname', `lname` = '$lname', `user_type` = '$brgy', `photo` = '$uploadPath',phone='$phone',user_type=1 WHERE `tbl_user`.`user_id` = '$user'");
                            if ($update){
                                move_uploaded_file($fileTmp, $uploadPath);
                                echo '<script>alert("Updated Successfully admin account.");window.open("profile.php","_self");</script>';
                            }else{
                                echo '<script>alert("Error encounter while updating account.")</script>';
                            }
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Municipality</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Municipality</th>
                                    <th>Contact Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $collector=mysqli_query($con,"select * from tbl_user inner join municpality on tbl_user.user_m_id=municpality.m_id where user_type=1");
                                if (mysqli_num_rows($collector)>0){
                                    $i=1;
                                    while ($col=mysqli_fetch_assoc($collector)){
                                        $current_id =  'id_'.$i;
                                        $i++;
                                        ?>
                                        <tr>
                                            <td class="text-center"><a href="<?=$col['photo']?>" target="_blank" onclick="window.open(this.href,width=600,height=800); return false;"><img src="<?=$col['photo']?>" class="rounded-circle" width="50" height="50"></a></td>
                                            <td><?=$col['fname']." ".$col['mname']." ".$col['lname']?></td>
                                            <td>Administrator of <?=$col['m_name']?></td>
                                            <td><?=$col['m_name']?></td>
                                            <td><?=$col['phone']?></td>
                                            <td class="text-center"><?php
                                                if ($col['accnt_status']=="active"){
                                                    echo '<span class="badge badge-success">'.ucfirst($col['accnt_status']).'</span>';
                                                }else{
                                                    echo '<span class="badge badge-danger">'.ucfirst($col['accnt_status']).'</span>';
                                                }
                                                ?></td>
                                            <td>
                                                <button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?=$current_id?>"><i class="fa fa-pencil-alt"></i></button>
                                                <a href="deleteAccount.php?id=<?=$col['user_id']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <!-- EditAdmin Modal-->
                                                <div class="modal fade" id="<?=$current_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                     aria-hidden="true">
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Update Admin Account</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <input type="hidden" name="user_id" value="<?=$col['user_id']?>">
                                                                        <div class="col-sm-5 mb-3 mb-sm-0">
                                                                            <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="fname"  autofocus value="<?=$col['fname']?>" title="Firstname">
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control form-control-user" placeholder="M.I." name="mname" value="<?=$col['mname']?>" title="Middle Initial">
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="lname" value="<?=$col['lname']?>"  title="Lastname">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" value="<?=$col['email']?>"  title="Email">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control form-control-user"  placeholder="Username" name="username" value="<?=$col['username']?>"  title="Username">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control form-control-user"  placeholder="Contact Number" name="phone" value="<?=$col['phone']?>"  title="Contact Number">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <select name="municipality" class="form-control form-control-user" title="Municipality">
                                                                            <option >Select Municipality</option>
                                                                            <?php
                                                                            $mun=mysqli_query($con,"SELECT * FROM municpality ORDER BY m_name ASC;");
                                                                            if (mysqli_num_rows($mun)>0){
                                                                                while ($m=mysqli_fetch_assoc($mun)){
                                                                                    if ($m['m_id']== $_SESSION['user_m_id']) {
                                                                                        echo '<option value="' . $m['m_id'] . '" selected>' . $m['m_name'] . '</option>';
                                                                                    }else{
                                                                                        echo '<option value="' . $m['m_id'] . '" >' . $m['m_name'] . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <select name="status" class="form-control form-control-user" title="Account Status">
                                                                            <?php
                                                                            if ($col['accnt_status']=="active"){
                                                                                ?>
                                                                                <option value="<?=$col['accnt_status']?>" selected>Active</option>
                                                                                <option value="inactive">Inactive</option>
                                                                                <?php
                                                                            }else{
                                                                                ?>
                                                                                <option value="active">Active</option>
                                                                                <option value="inactive" selected>Inactive</option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="row container">
                                                                        <img src="<?=$col['photo']?>" alt="" class="rounded-circle mb-1" width="100" height="100">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="file" accept=".jpg,.jpeg,.png" class="form-control"  placeholder="Upload Photo" name="file" title="Upload Photo" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                                                                    <button class="btn btn-success btn-sm" type="submit" name="update">Submit</button>
                                                                    <button class="btn btn-primary btn-sm" type="reset">Reset</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
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