<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./main.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 wrap-login-mahdi">
                <!-- <div class="login100-pic js-tilt" data-tilt>
                    <img src="https://colorlib.com/etc/lf/Login_v1/images/img-01.png" alt="IMG">
                </div> -->

                <!-- <form class="login100-form validate-form"> -->
                <span class="login100-form-title">

                    <?php
                    if (isset($_SESSION['loggedUser'])) {

                        // echo $_SESSION['users']
                        echo " Welcome " . ($_SESSION['loggedUser']['username']) . "<br/>";
                        echo " Your Email " . ($_SESSION['loggedUser']['email']) . "<br/>";
                        echo
                        '
                        <div class="container-login100-form-btn">
                        <a href="./index.php" class="login100-form-btn">
                            Go to home page
                        </a>
                    </div>
                        ';
                    } else {
                        echo "You are not logged in!";
                        echo
                        '
                        <div class="container-login100-form-btn">
                        <a href="./index.php" class="login100-form-btn">
                            Go to home page
                        </a>
                    </div>
                        ';
                    }

                    // var_dump($_SESSION)
                    // echo $_POST['name'];
                    ?>

                </span>
                <!-- 
                <div class="container-login100-form-btn">
                    <a href="./index.php" class="login100-form-btn">
                        Go to home page
                    </a>
                </div>

                <div class="container-login100-form-btn">
                    <a href="./index.php" class="login100-form-btn">
                        Not Logged in!

                    </a>
                </div> -->


                <!-- <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div> -->

                <!-- <div class="container-login100-form-btn">
                    <a href="./login.php" class="login100-form-btn">
                        Login
                    </a>
                </div>


                <div class="container-login100-form-btn">
                    <a href="./register.php" type="submit" class="register100-form-btn">
                        Signup
                    </a>
                </div> -->

                <!-- <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div> -->

                <!-- <div class="text-center p-t-136">
                        <a class="txt2" href="./register.php">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div> -->
                <!-- </form> -->
            </div>
        </div>
    </div>
</body>

</html>