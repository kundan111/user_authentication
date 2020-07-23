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
    <title>Sign up</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<?php


//first check if a user is logged in for current session id
$user_obj = NULL;
$user_id = NULL;
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
        $pass2 = $_POST['password2'];

        $account = new Account();

        try {
            $user_id = $account->addAccount($username, $pass1);
        } catch (Exception $e) {

            echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">×</button><strong>';
            echo $e->getMessage();
            echo '</strong></div>';
        }

        if ($user_id) {
            // a new account is created successfully

            // log the user in
            $account->login($username, $pass1);

            // store this object in session super global
            $_SESSION['logged_user_object'] = serialize($account);

            header("location: welcome.php");
        }
    }
}



// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     //do some value checks here as well
//     $username = $_POST['username'];
//     $pass1 = $_POST['password'];
//     $pass2 = $_POST['password2'];




//     try {
//         $user_id = $account->addAccount($username, $pass1);
//     } catch (Exception $e) {

//         echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">×</button><strong>';
//         echo $e->getMessage();
//         echo '</strong></div>';
//     }
//     if ($user_id) {
//         echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">×</button><strong>';
//         echo "Account acreated for $username";
//         echo '</strong></div>';

//         // log the user in 

//         $account->login($username, $pass1);

//         $_SESSION['logged_user_object'] = serialize($account);

//         header("location: welcome.php");
//     }
// }else if($_SERVER["REQUEST_METHOD"] == "GET")
// {

// }
?>

<body>
    <div class="container">
        <div id="login-box">
            <div class="left">
                <h1>Sign up</h1>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="text" name="username" placeholder="Username" />
                    <input type="password" name="password" placeholder="Password" />
                    <input type="password" name="password2" placeholder="Retype password" />

                    <input type="submit" name="signup_submit" value="Sign me up" />
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>