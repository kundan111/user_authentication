<?php
session_start();

require './db_inc.php';
require './account_class.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
    <link rel="stylesheet" href="css/style.css">
</head>


<?php

$user_obj = NULL;
if (isset($_SESSION['logged_user_object'])) {
    $user_obj = unserialize($_SESSION['logged_user_object']);
}

if ($user_obj) {
    // there is a user object 
    // now check if the request method is get

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("location: welcome.php");
    }
} else {
    // there is no user logged in
    // now check for method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = $_POST['username'];
        $pass1 = $_POST['password'];


        $account = new Account();

        try {
            $is_logged_in = $account->login($username, $pass1);
        } catch (Exception $e) {

            echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">×</button><strong>';
            echo $e->getMessage();
            echo '</strong></div>';
        }

        if ($is_logged_in) {
            $_SESSION['logged_user_object'] = serialize($account);

            header("location: welcome.php");
        }
    }
}






// create a Account object
// $account = new Account();

// // if there is a active session then directly 302 to welcome.php
// $res = $account->get_user_with_this_sessionId();

// if ($res) {
//     // there is a active sesion directly move to welcome.php
//     header("location: welcome.php");
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // comeing for actual login

//     // get username and password

//     $user = $_POST["username"];
//     $pass = $_POST["password"];

//     $res = $account->login($user, $pass);
//     $_SESSION['logged_user_object'] = serialize($account);
//     if ($res) {
//         header("location: welcome.php");
//     }
// }

?>

<body>
    <div class="container">
        <div id="login-box">
            <div class="left">
                <h1>Login</h1>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="text" name="username" placeholder="Username" />
                    <input type="password" name="password" placeholder="Password" />
                    <input type="submit" name="signup_submit" value="Login" />
                </form>
            </div>
        </div>
    </div>

</body>

</html>