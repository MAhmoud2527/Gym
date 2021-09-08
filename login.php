<?php

// Connection
require 'include/function/function.php';
require 'include/template/connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = CleanInputs($_POST['email']);
    $password = CleanInputs($_POST['password']);
    $role = $_POST['usertype'];
    $erros = [];
    if (!Validator($email, 1)) {
        $erros['email'] = "Email Field Required";
    }
    if (!Validator($email, 4)) {
        $erros['email'] = "Filed Must Be a Valid Email";
    }
    if (!Validator($password, 1)) {
        $erros['password'] = "Email Field Required";
    }
    if (count($erros) > 0) {
        $_SESSION['messages'] = $erros;
    } else {
        $password = sha1($password);
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND user_type_id = $role";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $data = mysqli_fetch_assoc($result);
            if ($role == 1) {
                $_SESSION['role'] = 'admin';
                $_SESSION['userData'] = $data;
                header('Location: admin/index.php');
            } elseif ($role == 2) {
                $_SESSION['role'] = 'manager';
                $_SESSION['userData'] = $data;
                header('Location: manager/index.php');
            } elseif ($role == 3) {
                $_SESSION['role'] = 'coach';
                $_SESSION['userData'] = $data;
                header('Location: coach/index.php');
            } elseif ($role == 4) {
                $_SESSION['role'] = 'trainee';
                $_SESSION['userData'] = $data;
                header('Location: trainee/index.php');
            }
        } else {
            $_SESSION['messages']  = ['Invalid email || Password'];
        }
    }
}
// print_r($_SESSION);

?>









<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login Page</title>
    <link rel="apple-touch-icon" href="assets/>
        <link rel=" shortcut icon" type="image/x-icon" href="assets/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="shortcut icon" href="https://localhost/gym/assets/app-assets/images/fav.png" type="image/x-icon">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="assets/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="assets/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="assets/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="assets/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="assets/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="assets/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="assets/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="assets/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="assets/app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column navbar-floating
        footer-static bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">


                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex
                            justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-12 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Login</h4>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($_SESSION['messages'])) {
                                            foreach ($_SESSION['messages'] as  $value) {
                                                # code...
                                                echo "<div class='alert alert-danger text-center'>" . $value . "</div>";
                                            }

                                            unset($_SESSION['messages']);
                                        }
                                        ?>
                                        <br>
                                        <p class="px-2">Welcome back, please
                                            login to your account.</p>

                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                                                    <fieldset class="form-label-group
                                                            form-group
                                                            position-relative
                                                            has-icon-left">
                                                        <input type="email" class="form-control" id="user-name" placeholder="Email" name="email" required>
                                                        <div class="form-control-position">
                                                            <i class="feather
                                                                    icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Email</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group
                                                            position-relative
                                                            has-icon-left">
                                                        <input type="password" class="form-control" id="user-password" placeholder="Password" name="password" required>
                                                        <div class="form-control-position">
                                                            <i class="feather
                                                                    icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Password</label>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <select class="form-control" id="basicSelect" name="usertype">
                                                            <?php
                                                            // Select Data for drobdown Menu
                                                            $query = "SELECT * FROM `usertype` WHERE 1";
                                                            $result = mysqli_query($conn, $query);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                                <option value="<?php echo  $row['id']; ?>"><?php echo  $row['title']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </fieldset>

                                                    <button type="submit" class="btn
                                                            btn-primary btn-block
                                                            float-right
                                                            btn-inline">Login</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="login-footer">
                                            <div class="divider">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="assets/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="assets/app-assets/js/core/app-menu.js"></script>
    <script src="assets/app-assets/js/core/app.js"></script>
    <script src="assets/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>