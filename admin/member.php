<?php

require '../include/function/function.php';
require '../include/function/checkLogin.php';
require '../include/function/checkLoginA.php';
require '../include/template/connection.php';

$profileImage = '../uploads/' . $_SESSION['role'] . '/';

$folder = '../uploads/manager/';
$sql = "SELECT users.*,country.country_name  as country FROM users  JOIN country ON users.country_id = country.id WHERE user_type_id = 2 order by users.id DESC";
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
                                    mb-0">Members</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="member.php">Member</a>
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
                                <a href="add.php" class="btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; Add New Member</a>
                                <div class="table-responsive">
                                    <table class="table
                                                    zero-configuration" id="info_data">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Img</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Country</th>
                                                <th>Time</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            while ($data = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $i++ ?></td>
                                                    <td><img src="<?php echo $folder . $data['photo'] ?>" alt="" width="60px" height="60px"> </td>
                                                    <td><?php echo $data['username'] ?></td>
                                                    <td><?php echo $data['email'] ?></td>
                                                    <td><?php echo $data['phone'] ?></td>
                                                    <td><?php echo $data['country'] ?></td>
                                                    <td><?php echo fotmatDate($data['user_created_at']); ?></td>
                                                    <td>
                                                        <a href="edit.php?id=<?php echo $data['id']; ?>" type="button" class="btn bg-gradient-info waves-effect waves-light">Edit</a>
                                                        <a href="delete.php?id=<?php echo $data['id']; ?>" type="button" class="btn bg-gradient-danger waves-effect waves-light">Delete</a>

                                                    </td>
                                                </tr>
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