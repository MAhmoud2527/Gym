<!-- Chech if isset session -->
<?php
require '../include/function/function.php';
// require '../include/function/checkLogin.php'; 
require '../include/function/checkLoginT.php';
require '../include/template/connection.php';

$related_user = $_SESSION['userData']['id'];
$profileImage = '../uploads/' . $_SESSION['role'] . '/';

$id = $_GET['id'];

$sql2 = "SELECT images.name , images.exe_id , exercises.*  , days.day_name  FROM images JOIN exercises on exe_id = exercises.id JOIN days on 
days.id = exercises.day_id where exercises.day_id = $id";
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
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card-deck-wrapper">
                                                    <div class="card-deck">
                                                        <div class="card">
                                                            <div class="card-content" id="info<?php echo $data['id']; ?>">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">Exersises Name is <b style="color: #7367F0;">[ <?php echo  $data2['exercises_name'] ?> ]</b></h4>
                                                                    <p class="card-text">Number of Set <b style="color: #7367F0;">[ <?php echo  $data2['sets'] ?> ]</b></p>
                                                                    <?php while ($data2 = mysqli_fetch_assoc($result2)) { ?>
                                                                        <img class="img-fluid" width="260px" height="260px" style="margin: 10px;" src="../uploads/exercises/<?php echo  $data2['name'] ?>" alt="">
                                                                    <?php } ?>
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