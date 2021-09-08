<!-- Chech if isset session -->
<?php

require '../include/function/function.php';
// require '../include/function/checkLogin.php'; 
require '../include/function/checkLoginC.php';
require '../include/template/connection.php';

$related_user = $_SESSION['userData']['id'];
$profileImage = '../uploads/' . $_SESSION['role'] . '/';

// Get Row Count
$sql = "SELECT trainees_more_info.*,users.username , package.package_name FROM trainees_more_info join users on trainees_more_info.coach_id = $related_user AND `user_type_id`= 4 join package
on package.id = trainees_more_info.package_id";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

$sql2 = "SELECT exercises.add_by FROM  exercises where exercises.add_by = $related_user";
$result2 = mysqli_query($conn, $sql2);
$num2 = mysqli_num_rows($result2);

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
                                    mb-0">Dashboard</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0"><?php echo $num;  ?></h2>
                                <p>Trainees</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <a href="#"> <i class="feather icon-users  text-warning font-medium-5"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0"><?php echo $num2; ?></h2>
                                <p>Exercises</p>
                            </div>
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <a href="view.php"><i class="feather icon-list text-danger font-medium-5"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="feather icon-activity"> </i>More Detials</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="info_data">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Package</th>
                                                        <th>Weight</th>
                                                        <th>Height</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1;
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($members = mysqli_fetch_assoc($result)) { ?>
                                                        <tr>
                                                            <td><?php echo $i++ ?></td>
                                                            <td><?php echo $members['username'] ?></td>
                                                            <td><?php echo $members['package_name'] ?></td>
                                                            <td><?php echo $members['weight'] ?></td>
                                                            <td><?php echo $members['height'] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->


<?php require '../include/template/footer.php'; ?>