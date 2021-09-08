<?php
require '../include/function/function.php';
// require '../include/function/checkLogin.php';
require '../include/function/checkLoginM.php';
require '../include/template/connection.php';

$related_user = $_SESSION['userData']['id'];

$profileImage = '../uploads/' . $_SESSION['role'] . '/';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = CleanInputs($_POST['username']);
    $email = CleanInputs($_POST['email']);
    $password = CleanInputs($_POST['password']);
    $phone = CleanInputs($_POST['phone']);
    $country = $_POST['country'];
    $errors = [];

    if (!Validator($name, 1)) {
        $errors['name'] = "Name Field Is Required";
    } elseif (!Sanitize($name, 2)) {
        $errors['name'] = "Name Must be a String";
    }

    if (!Validator($email, 1)) {
        $errors['email'] = "Email Field Is Required";
    } elseif (!Validator($email, 4)) {
        $errors['email'] = "Email Filed Must Be a Valid Email";
    }

    if (!Validator($password, 1)) {
        $errors['password'] = "Password Field Is Required";
    } elseif (!Validator($password, 2, 6)) {
        $errors['password'] = "password Can't be less than 6 chars";
    }

    if (!Validator($phone, 1)) {
        $errors['phone'] = "Phone Field Is Required";
    } elseif (!Sanitize($phone, 1)) {
        $errors['phone'] = "Phone Field Must be a Number";
    }

    if (!Validator($country, 1)) {
        $errors['country'] = "Country Field Is Required";
    }

    // image Upload 
    $name_img = $_FILES['image']['name'];
    $name_type = $_FILES['image']['type'];
    $name_size = $_FILES['image']['size'];
    $name_temp = $_FILES['image']['tmp_name'];

    $nameImageArray = explode('/', $name_type);
    $exection = strtolower(end($nameImageArray));
    $exectionArray = array('png', 'jpg', 'jpeg', 'ico');
    $finalName = rand() . time() . '.' . $exection;
    $folder = '../uploads/coach/';
    $finalImageName = $folder .  $finalName;

    // Check Error Count
    if (empty($errors)) {
        if (move_uploaded_file($name_temp, $finalImageName)) {
            $imgName =  $finalName;
        } else {
            $errors['image'] = "Error in Upload Try Again";
        }
        $password = sha1($password);
        // insert data
        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `phone`, `photo`, `country_id`, `user_type_id` , `add_by`) VALUES ('$name' , '$email' , '$password', $phone , '$finalName',  '$country' , 3 , $related_user)";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: coach.php");
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
                                <li class="breadcrumb-item"><a href="add.php">Add Coach</a>
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
                            <h4 class="card-title"> <i class="feather  icon-plus-circle"></i> Add New Coach</h4>

                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="first-name-floating-icon" class="form-control" name="username" placeholder="User Name">

                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="first-name-floating-icon">User Name</label>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['name'])) {
                                                            echo $errors['name'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="email" id="email-id-floating-icon" class="form-control" name="email" placeholder="Email">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-mail"></i>
                                                    </div>
                                                    <label for="email-id-floating-icon">Email</label>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['email'])) {
                                                            echo $errors['email'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="password" id="password-floating-icon" class="form-control" name="password" placeholder="Password">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                    <label for="password-floating-icon">Password</label>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['password'])) {
                                                            echo $errors['password'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="number" id="contact-floating-icon" class="form-control" name="phone" placeholder="Phone">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-smartphone"></i>
                                                    </div>
                                                    <label for="contact-floating-icon">Phone</label>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['phone'])) {
                                                            echo $errors['phone'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-floating-icon">Choose Country</label>
                                                    <select class="select2-theme form-control" id="select2-theme" name="country">
                                                        <option value="0">Chosee Country</option>
                                                        <?php
                                                        // Select Data for drobdown Menu
                                                        $query = "SELECT * FROM `country` WHERE 1";
                                                        $result = mysqli_query($conn, $query);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                            <option value="<?php echo  $row['id']; ?>"><?php echo  $row['country_name']; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['country'])) {
                                                            echo $errors['country'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="contact-floating-icon">Upload Photo</label>
                                                <div class="form-label-group">
                                                    <input type="file" class="form-control" name="image">
                                                    <div class="form-control-position">
                                                    </div>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['image'])) {
                                                            echo $errors['image'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Add</button>
                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
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