<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto"><a class="navbar-brand" href="https://localhost/gym/<?php echo $_SESSION['role']; ?>/index.php">
          <h2 class="brand-text mb-0">Fitness Gym</h2>
        </a></li>
      <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
    </ul>
  </div>

  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <!--  End Admin Side Menu -->
      <?php if ($_SESSION['userData']['user_type_id'] == 1) { ?>
        <li class=" nav-item"><a href="index.php"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
        </li>
        <li class="nav-item has-sub"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">Members</span></a>
          <ul class="menu-content">
            <li><a href="add.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add Member</span></a>
            </li>
            <li><a href="member.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">View Member</span></a>
            </li>
          </ul>
        </li>


      <?php } ?>
      <!--  End Admin Side Menu -->

      <!--  Start Manager Side Menu -->
      <?php if ($_SESSION['userData']['user_type_id'] == 2) { ?>

        <li class=" nav-item"><a href="index.php"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
        </li>
        <li class="nav-item has-sub"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">coachs</span></a>
          <ul class="menu-content">
            <li><a href="coach_add.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add coach</span></a>
            </li>
            <li><a href="coach.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">View coach</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-sub"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="User">Package</span></a>
          <ul class="menu-content">
            <li><a href="package_add.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add Package</span></a>
            </li>
            <li><a href="package.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">View Package</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-sub"><a href="#"><i class="feather icon-layers"></i><span class="menu-title" data-i18n="User">Trainee</span></a>
          <ul class="menu-content">
            <li><a href="trainee_add.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add Trainne</span></a>
            </li>
            <li><a href="trainee.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">View Trainne</span></a>
            </li>
          </ul>
        </li>
      <?php } ?>
      <!--  End Manager Side Menu -->


      <!--  Start Coach Side Menu -->
      <?php if ($_SESSION['userData']['user_type_id'] == 3) { ?>
        <li class=" nav-item"><a href="index.php"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
        </li>
        <li class="nav-item has-sub"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="User">Exercises</span></a>
          <ul class="menu-content">
            <li><a href="add.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Add Exercise</span></a>
            </li>
            <li><a href="view.php"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">View Exercises</span></a>
            </li>
          </ul>
        </li>

      <?php } ?>
      <!--  End Coach Side Menu -->


      <!--  Start Trainee Side Menu -->
      <?php if ($_SESSION['userData']['user_type_id'] == 4) { ?>

        <li class=" nav-item"><a href="index.php"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
        </li>
        <li class=" nav-item"><a href="view.php"><i class="feather icon-list"></i><span class="menu-title">Exersise</span></a>
        </li>
      <?php } ?>
      <!--  End Trainee Side Menu -->
    </ul>
  </div>
</div>
<!-- END: Main Menu-->