<?php

session_start();

session_destroy();

header("Location: https://localhost/gym/login.php");
