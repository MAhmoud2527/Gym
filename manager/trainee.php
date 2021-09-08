<?php

require '../include/function/function.php';
// require '../include/function/checkLogin.php';
require '../include/function/checkLoginM.php';
require '../include/template/connection.php';

$related_user = $_SESSION['userData']['id'];
$profileImage = '../uploads/' . $_SESSION['role'] . '/';

$folder = '../uploads/trainee/';
// Select from 4 Tables
$sql = "SELECT users.id as userId , users.username , users.email , users.password , users.photo , users.phone , users.country_id, users.country_id, users.user_type_id , users.user_created_at ,country.country_name  as country ,trainees_more_info.* , package.* FROM users  JOIN country ON users.country_id = country.id join trainees_more_info on trainees_more_info.more_info = users.id join package on package.id = trainees_more_info.package_id WHERE user_type_id = 4 and users.add_by = $related_user order by users.id DESC";
$result = mysqli_query($conn, $sql);

require '../include/template/header.php';
require '../include/template/sidemenu.php';
?>

<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <!-- Right nav header -->
                </div>

                <ul class="nav navbar-nav float-right">

                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>



                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600"><?php echo $_SESSION['userData']['username']; ?></span><span class="user-status">Available</span></div><span><img class="round" src="<?php echo $profileImage . $_SESSION['userData']['photo']; ?>" alt="avatar" height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="edit_profile.php?id=<?php echo $_SESSION['userData']['id']; ?>"><i class="feather icon-user"></i> Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php"><i class="feather icon-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left
                                    mb-0">Trainee</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="trainee.php">Trainee</a>
                                </li>


                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Table Start -->
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> </h4>
                        </div>
                        <div class="card-content">

                            <div class="card-body card-dashboard">
                                <a href="trainee_add.php" class="btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; Add New Trainee</a>
                                <div class="table-responsive">
                                    <table class="table
                                                    zero-configuration" id="info_data">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Img</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Package</th>
                                                <th>Coach</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            while ($data = mysqli_fetch_assoc($result)) {
                                                $coash_id = $data['coach_id'];
                                                $sql = "SELECT `username` FROM `users` WHERE id = $coash_id";
                                                $res = mysqli_query($conn, $sql);
                                                $rest = mysqli_fetch_assoc($res);

                                                $dateStamp = $data['user_created_at'];
                                                $num = $data['month_num'];
                                                $date = new DateTime($dateStamp);
                                                $datesArr = $date->format('Y/m/d');
                                                $dateEnd =  $date->modify('+ ' . $num . 'month');
                                                $dateEnd = $date->format('Y/m/d');
                                                $date_today =  date('Y/m/d');
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++ ?></td>
                                                    <td><img src="<?php echo $folder . $data['photo'] ?>" alt="" width="60px" height="60px"> </td>
                                                    <td><?php echo $data['username'] ?></td>
                                                    <td><?php echo $data['phone'] ?></td>
                                                    <td><?php echo $data['package_name'] ?></td>
                                                    <td><?php echo $rest['username'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn bg-gradient-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal<?php echo $data['userId']; ?>">View</button>

                                                        <a href="trainee_edit.php?id=<?php echo $data['userId']; ?>" type="button" class="btn bg-gradient-info waves-effect waves-light">Edit</a>

                                                        <a href="trainee_delete.php?id=<?php echo $data['userId']; ?>" type="button" class="btn bg-gradient-danger waves-effect waves-light">Delete</a>

                                                    </td>
                                                </tr>
                                                <!-- Start Modal -->
                                                <div class="modal fade text-left" id="myModal<?php echo $data['userId']; ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel16"><i class="feather icon-plus"></i> More Info</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <span><b>Name :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $data['username'] ?>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span><b>Email :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $data['email'] ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <span><b>Phone :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $data['phone'] ?>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span><b>Country :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $data['country'] ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <span><b>Weight :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $data['weight'] . ' (kg)'; ?>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span><b>Height :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $data['height'] . ' (cm)'; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <span><b>Coach Name :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $rest['username']; ?>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span><b>Package Name :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $data['package_name']; ?>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <span><b>Start Date :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $datesArr; ?>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span><b>End Date :</b></span>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <?php echo $dateEnd; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <span><b>Status :</b></span>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <?php

                                                                        if ($dateEnd > $date_today) { ?>
                                                                            <div class="badge badge-pill badge-glow badge-success mr-1 mb-1">Active</div>

                                                                        <?php } else { ?>
                                                                            <div class="badge badge-pill badge-glow badge-danger mr-1 mb-1">Deactive</div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="trainee_edit.php?id=<?php echo $data['userId']; ?>" type="button" class="btn bg-gradient-info waves-effect waves-light">Edit</a>

                                                                <a href="trainee_delete.php?id=<?php echo $data['userId']; ?>" type="button" class="btn bg-gradient-danger waves-effect waves-light">Delete</a>
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Model -->
                                            <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Data table End -->


    </div>
</div>
</div>
<!-- END: Content-->

<?php require '../include/template/footer.php'; ?>