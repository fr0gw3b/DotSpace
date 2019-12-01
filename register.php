<?php

require '@/config.php';
require '@/functions.php';

session_start();

$user = new users;

if ($user -> UserIsConnected())

{

    header('Location: index.php');

}

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DotSpace - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <?php
                if(isset($_POST['register'])){
                    $username  = $_POST['username'];
                    $mail      = $_POST['mail'];
                    $password  = $_POST['password'];
                    $cpassword = $_POST['cpassword'];

                    $hash = hash("sha512", $password);

                    if(!empty($username) && !empty($mail) && !empty($password) && !empty($cpassword)){
                        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                            if($password == $cpassword){
                                $info = $odb -> prepare('SELECT * FROM users WHERE username = ? AND email = ?');
                                $info->execute(array($username, $mail));
                                $count = $info->rowCount();
                                if($count < 1){
                                    $reqUser = $odb -> prepare('INSERT INTO users (username, password, email, rank, membership, expire, status) VALUES (?, ?, ?, 0, 0, 0, 0)');
                                    $reqUser -> execute(array($username, $hash, $mail));
                                    $reqExistUser = $odb -> prepare('SELECT * FROM users WHERE username = ? AND password = ?');
                                    $reqExistUser->execute(array($username, $hash));
                                    $ExistUser = $reqExistUser->rowCount();
                                    if($ExistUser == 1){
                                        $getInfo = $reqExistUser->fetch();
                                        $_SESSION['id'] = $getInfo['id'];
                                        $_SESSION['username'] = $getInfo['username'];
                                        $_SESSION['mail'] = $getInfo['email'];

                                        echo alert("success", "Success !", "You are registered !");

                                        header('Location: index.php');
                                    } else {
                                        echo alert("danger", "Error !", "A problem has occurred");
                                    }
                                } else {
                                    echo alert("danger", "Error !", "Username or email address already used");
                                }
                            } else {
                                echo alert("danger", "Error !", "The two passwords do not match");
                            }
                        } else {
                            echo alert("danger", "Error !", "Enter a valid email !");
                        }
                    } else {
                        echo alert("danger", "Error !", "All fields is required");
                    }
                }
            ?>
        <div class="container">
            <div class="login-box ptb--100">
                <form method="post">
                    <div class="login-form-head">
                        <h4>Sign up</h4>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="username">Pseudonyme</label>
                            <input type="text" id="username" name="username">
                            <i class="ti-user"></i>
                        </div>
                        <div class="form-gp">
                            <label for="mail">Email address</label>
                            <input type="email" id="mail" name="mail">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="form-gp">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" id="cpassword" name="cpassword">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="register">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="login.html">Sign in</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
