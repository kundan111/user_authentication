<?php
session_start();

require './db_inc.php';
require './account_class.php';

$account = new Account();

// print_r($_SERVER);



?>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="username">Username</label>
    <input type="text" name="username"><br>
    <label for="password">Password</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>