<?php
require '../include/function/function.php';
// require '../include/function/checkLogin.php'; 
require '../include/function/checkLoginC.php';
require '../include/template/connection.php';

$related_user = $_SESSION['userData']['id'];
$profileImage = '../uploads/' . $_SESSION['role'] . '/';
// Get id from url
$id = $_GET['id'];

$sql = "SELECT exercises.*,users.username FROM  exercises join users on exercises.add_by = users.id and exercises.add_by = $related_user";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = CleanInputs($_POST['name']);
    $num = CleanInputs($_POST['num']);
    $day = $_POST['day'];
    $trainee = $_POST['trainee'];
    $errors = [];

    if (!Validator($name, 1)) {
        $errors['name'] = "Name Field Is Required";
    } elseif (!Sanitize($name, 2)) {
        $errors['name'] = "Name Must be a String";
    }


    if (!Validator($num, 1)) {
        $errors['num'] = "Number Field Is Required";
    } elseif (!Sanitize($num, 1)) {
        $errors['num'] = "Number Field Must be a Number";
    }

    if (!Validator($day, 1)) {
        $errors['day'] = "Day Field Is Required";
    }

    if (!Validator($trainee, 1)) {
        $errors['trainee'] = "Trainee Field Is Required";
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
    $folder = '../uploads/exercises/';
    $finalImageName = $folder .  $finalName;
    // Check Before Upload 
    if (in_array($exection, $exectionArray)) {
        if (move_uploaded_file($name_temp, $finalImageName)) {
            unlink($folder . $oldImage); // Delete image from Folder
        }
    } else {
        $finalName =  $oldImage; // Set old Value For image
    }

    // Check Error Count
    if (empty($errors)) {
        // Update Query
        $sql = "update exercises set exercises_name='$name' , sets='$num' , add_by = $related_user , day_id = $day , trainee_id = '$trainee' where id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: view.php");
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
                                    mb-0">Exercises
                        </h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="add.php">Add Exercises
                                    </a>
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
                            <h4 class="card-title"> <i class="feather  icon-plus-circle"></i> Add New Exercises
                            </h4>

                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="first-name-floating-icon" class="form-control" name="name" placeholder="Name" value="<?php echo $data['exercises_name']  ?>">

                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="first-name-floating-icon">Name</label>
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
                                                    <input type="number" id="first-name-floating-icon" class="form-control" name="num" placeholder="Number of set" value="<?php echo $data['sets']  ?>">

                                                    <div class="form-control-position">
                                                        <i class="feather icon-grid"></i>
                                                    </div>
                                                    <label for="first-name-floating-icon">Number of set</label>
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
                                                <div class="form-group">
                                                    <select class="select2-theme form-control" id="select2-theme" name="day">
                                                        <option value="0">Chosee Day</option>
                                                        <?php
                                                        // Select Data for drobdown Menu
                                                        $query = "SELECT * FROM `days`";
                                                        $result = mysqli_query($conn, $query);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                            <option value="<?php echo  $row['id']; ?>" <?php if ($row['id'] == $data['day_id']) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo  $row['day_name']; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['day'])) {
                                                            echo $errors['day'];
                                                        }
                                                        ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <select class="select2-theme form-control" id="select2-theme2" name="trainee">
                                                        <option value="0">Chosee Trainee</option>
                                                        <?php
                                                        // Select Data for drobdown Menu
                                                        $query = "SELECT trainees_more_info.*,users.username FROM trainees_more_info join users on trainees_more_info.coach_id = $related_user AND `user_type_id`= 4";
                                                        $result = mysqli_query($conn, $query);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                            <option value="<?php echo  $row['id']; ?>" <?php if ($row['id'] == $data['trainee_id']) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo  $row['username']; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                    <small class="error">
                                                        <?php
                                                        if (isset($errors['trainee'])) {
                                                            echo $errors['trainee'];
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