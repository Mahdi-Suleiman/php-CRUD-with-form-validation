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
    <link rel="stylesheet" href="style.css">
    <script src="./main.js"></script>

    <title>Document</title>
</head>

<body>
    <?php
    $name = $email = $password = $password2 = "";
    $nameFlag = $emailFlag = $passwordFlag = false;
    $nameError = $emailError = $passwordError = $password2Error = "";

    // $usersArray = [['name' => 'mahdi', 'email' => 'mh@gmail.com', 'password' => 123456789]];
    // array_push($_SESSION['users'], $usersArray);
    // $_SESSION['users'] = [['name' => 'mahdi', 'email' => 'mh@gmail.com', 'password' => '123456789']];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST['name'])) {
            $nameError = "Name is required";
        } else {
            $name = trimInput($_POST['name']);
            $nameFlag = true;
        }

        if (empty($_POST['email'])) {
            $emailError = "Email is required";
        } else {
            $email = trimInput($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid Email format";
                $email = "";
            } else {
                $email = trimInput($_POST['email']);
                foreach ($_SESSION['users'] as $key => $value) {
                    if ($value["email"] == $email) {
                        $emailError = "Email already exist!";
                        break;
                    } else {
                        $emailFlag = true;
                    }
                }
            }
        }

        if (empty($_POST['password'])) {
            $passwordError = "Password is required";
        } elseif (strlen(trimInput($_POST['password'])) < 8) {
            $passwordError = "Password can't be less than 8 charaters";
        } else {
            $password = $_POST['password'];
        }

        if (empty($_POST['password2'])) {
            $password2Error = "This field is required";
        } elseif (strlen(trimInput($_POST['password2'])) < 8) {
            $password2Error = "Password can't be less than 8 charaters";
        } else {
            $password2 = $_POST['password2'];
        }

        if ($password !== $password2) {
            $password2 = "Passwords do not match!";
        } else {
            $passwordFlag = true;
        }

        if ($nameFlag === true && $emailFlag === true && $passwordFlag === true) {
            $newUser = ['name' => "$name", 'email' => "$email", 'password' => "$password"];
            // $_SESSION['users'][] = $newUser;
            array_push($_SESSION['users'], $newUser);
            # or $_SESSION['users'][] = $newUser;
            header("Location: ./login.php");
            // echo "HI";
        }
    } #check if form is submitted


    function trimInput($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="https://thumbs.dreamstime.com/b/hospital-registration-icon-element-treatment-name-mobile-concept-web-apps-thin-line-hospital-registration-icon-c-116585313.jpg"
                        alt="IMG">
                </div>

                <form id="myForm" class="login100-form validate-form"
                    action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <span class="login100-form-title">
                        Member Register
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Valid user is required: ex@abc.xyz">
                        <input class="input100" type="text" name="name" placeholder="username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        <span class="error">
                            <?php
                            echo "<span>";
                            echo $nameError;
                            echo "</span>";

                            ?>
                        </span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                        <span class="error">
                            <?php
                            echo "<span>";
                            echo $emailError;
                            echo "</span>";
                            ?>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <span class="error">
                            <?php
                            echo "<span>";
                            echo $passwordError;
                            echo "</span>";
                            ?>
                        </span>

                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password2" placeholder="Confirm Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <span class="error">
                            <?php
                            echo "<span>";
                            echo $password2Error;
                            echo "</span>";
                            ?>
                        </span>

                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="register100-form-btn">
                            Signup
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="./login.php">
                            Already have an account?
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    const form = document.getElementById('myForm');
    form.preventDefault();
    </script>
</body>

</html>