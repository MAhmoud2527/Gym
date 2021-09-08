<!-- Chech if isset session -->
<?php
require '../include/function/function.php';
// require '../include/function/checkLogin.php'; 
require '../include/function/checkLoginT.php';
require '../include/template/connection.php';

$related_user = $_SESSION['userData']['id'];
$profileImage = '../uploads/' . $_SESSION['role'] . '/';

$sql = "SELECT days.* , exercises.day_id FROM days JOIN exercises ON exercises.day_id = days.id WHERE days.id = exercises.day_id";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT images.name , images.exe_id , exercises.*  , days.day_name  FROM images JOIN exercises on exe_id = exercises.id JOIN days on 
days.id = exercises.day_id";
$result2 = mysqli_query($conn, $sql2);
$data2 = mysqli_fetch_assoc($result2);

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
                                    mb-0">Exersises</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="view.php">Exersises</a>
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
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card" style="height: 278.875px;">
                                            <div class="card-header">
                                                <h4 class="card-title">Exercise Days</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <ul class="nav flex-column">
                                                        <?php $i = 1;
                                                        while ($data = mysqli_fetch_assoc($result)) { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link active" href="more.php?id=<?php echo $data['id']; ?>"><?php echo $i++ . '- ' . $data['day_name']; ?></a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
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
        </section>
        <!--/ Data table End -->
    </div>
</div>
</div>
<!-- END: Content-->

<?php require '../include/template/footer.php'; ?>