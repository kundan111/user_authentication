<?php
session_start();
require './db_inc.php';
require './account_class.php';

if (isset($_SESSION['logged_user_object'])) {
    $user_obj = unserialize($_SESSION['logged_user_object']);
    $user_obj->logout();
    unset($_SESSION['logged_user_object']);
    header("location: login.php");
}
