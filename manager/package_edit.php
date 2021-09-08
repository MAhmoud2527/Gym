<?php

require '../include/function/function.php';
// require '../include/function/checkLogin.php';
require '../include/function/checkLoginM.php';
require '../include/template/connection.php';

$profileImage = '../uploads/' . $_SESSION['role'] . '/';
$related_user = $_SESSION['userData']['id'];

// Get id from url
$id = $_GET['id'];
$sql = "SELECT * FROM `package` WHERE  id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = CleanInputs($_POST['title']);
    $amount = CleanInputs($_POST['amount']);
    $num = CleanInputs($_POST['num']);
    $errors = [];

    if (!Validator($title, 1)) {
        $errors['title'] = "Title Field Is Required";
    } elseif (!Sanitize($title, 2)) {
        $errors['title'] = "Title Must be a String";
    }


    if (!Validator($num, 1)) {
        $errors['num'] = "Number Field Is Required";
    } elseif (!Sanitize($num, 1)) {
        $errors['num'] = "Number Field Must be a Number";
    }

    if (!Validator($amount, 1)) {
        $errors['amount'] = "Amount Field Is Required";
    } elseif (!Sanitize($amount, 1)) {
        $errors['amount'] = "Amount Field Must be a Number";
    }

    // Check Error Count
    if (empty($errors)) {
        // Update data
        $sql = "update package set package_name='$title' , month_num = $num ,package_amount= $amount  ,add_by = $related_user where id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: package.php");
        }
    } else {
    }
}

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
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left
                                    mb-0">Dashboard</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Edit Package</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> <i class="feather  icon-plus-circle"></i> Edit Member</h4>

                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="first-name-floating-icon" class="form-control" name="title" placeholder="Title" value="<?php echo $data['package_name']; ?>">

                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="first-name-floating-icon">Title</label>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['title'])) {
                                                            echo $errors['title'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="number" id="first-name-floating-icon" class="form-control" name="num" placeholder="Number of Month" value="<?php echo $data['month_num']; ?>">

                                                    <div class="form-control-position">
                                                        <i class="feather icon-grid"></i>
                                                    </div>
                                                    <label for="first-name-floating-icon">Number of Month</label>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['num'])) {
                                                            echo $errors['num'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="number" id="email-id-floating-icon" class="form-control" name="amount" placeholder="amount" value="<?php echo $data['package_amount']; ?>">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-hash"></i>
                                                    </div>
                                                    <label for="email-id-floating-icon">Amount</label>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['amount'])) {
                                                            echo $errors['amount'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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