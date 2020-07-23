<?php

session_start();
require './db_inc.php';
require './account_class.php';

$user_obj = NULL;
if (isset($_SESSION['logged_user_object'])) {
    $user_obj = unserialize($_SESSION['logged_user_object']);
}


if (!$user_obj) {

    header("location: login.php");
} else {


    echo '<pre>';
    // print_r($user_obj);

    echo "<strong>Logged in user:</strong> " . $user_obj->getName();

    echo "<br><a  href = logout.php" . '>Logout</a>';
}
