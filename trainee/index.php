<!-- Chech if isset session -->
<?php
require '../include/function/function.php';
// require '../include/function/checkLogin.php'; 
require '../include/function/checkLoginT.php';
require '../include/template/connection.php';

$related_user = $_SESSION['userData']['id'];
$profileImage = '../uploads/' . $_SESSION['role'] . '/';


$sql = "SELECT users.* ,trainees_more_info.* , package.* FROM users join trainees_more_info on trainees_more_info.more_info = users.id join package on package.id = trainees_more_info.package_id WHERE user_type_id = 4 ";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
$dateStamp = $data['user_created_at'];
$num = $data['month_num'];

$date = new DateTime($dateStamp);
$start_date = $date->format('Y/m/d');
$dateEnd =  $date->modify('+' . $num . 'month');
$dateEnd = $date->format('Y/m/d');
$date_today =  date('Y/m/d');


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
                                <span class="text-bold-700 mb-0"><?php echo $start_date;  ?></span>
                                <p>Start Date</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <a href="#"> <i class="feather icon-plus-square  text-warning font-medium-5"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <span class="text-bold-700 mb-0"><?php echo $dateEnd; ?></span>
                                <p>End Date</p>
                            </div>
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <a href="#"><i class="feather icon-minus-square text-danger font-medium-5"></i></a>
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