<?php
session_start();
require('./config/config.php');

$_servername = "localhost";
$_username = "mahdi";
$_password = "123456";
$_dbname = "store";
// try {
//     $conn = new PDO("mysql:host=$_servername;dbname=$_dbname", $_username, $_password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     // # echo "connection successful";

//     // $_command = "SELECT * FROM users;";
//     // $statement = $conn->prepare("$_command");
//     // $statement->execute();
//     // $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
//     // # var_dump($result);

// } catch (PDOException $e) {
//     echo "connection failed" . $e->getMessage();
// }
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
    $username = $email = $password = $password2 = "";
    $usernameFlag = $emailFlag = $passwordFlag = false;
    $usernameError = $emailError = $passwordError = $password2Error = "";

    #check form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        #check username
        if (empty($_POST['username'])) {
            $usernameError = "Name is required";
        } else {
            $username = trimInput($_POST['username']);
            $usernameFlag = true;
        }

        #check email
        if (empty($_POST['email'])) {
            $emailError = "Email is required";
        } else {
            $email = trimInput($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid Email format";
                $email = "";
            } else {
                $email = trimInput($_POST['email']);
                $emailFlag = true;
            }
        }

        #check password
        if (empty($_POST['password'])) {
            $passwordError = "Password is required";
        } elseif (strlen(trimInput($_POST['password'])) < 8) {
            $passwordError = "Password can't be less than 8 charaters";
        } else {
            $password = $_POST['password'];
        }

        #check password2
        if (empty($_POST['password2'])) {
            $password2Error = "This field is required";
        } elseif (strlen(trimInput($_POST['password2'])) < 8) {
            $password2Error = "Password can't be less than 8 charaters";
        } else {
            $password2 = $_POST['password2'];
        }

        #check if they match
        if ($password !== $password2) {
            $password2 = "Passwords do not match!";
        } else {
            $passwordFlag = true;
        }
        #if they do :
        if ($usernameFlag === true && $emailFlag === true && $passwordFlag === true) {
            #try to insert user into database
            try {
                $sqlCommand = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
                echo $conn->exec($sqlCommand);
                echo "New record created successfully";
                header("Location: ./login.php");
            } catch (PDOException $e) {
                #email duplicate
                $emailError = "php error: email already exist";
            }
        }
    }

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
                    action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                    onsubmit="return validateForm(event)">
                    <span class="login100-form-title">
                        Member Register
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Valid user is required: ex@abc.xyz">
                        <input class="input100" id="username" type="text" name="username" placeholder="username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        <span class="error">
                            <?php
                            echo "<span>";
                            echo $usernameError;
                            echo "</span>";
                            ?>
                        </span>
                        <span class="error" id="usernameError"></span>

                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" id="email" type="email" name="email" placeholder="Email">
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
                        <span class="error" id="emailError"></span>

                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" id="password" type="password" name="password" placeholder="Password">
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
                        <span class="error" id="passwordError"></span>

                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" id="password2" type="password" name="password2"
                            placeholder="Confirm Password">
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
                        <span class="error" id="password2Error"></span>
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
    <!-- <script>
    const form = document.getElementById('myForm');
    form.preventDefault();
    </script> -->
</body>

</html>

<script type="text/javascript">
const validateForm = (event) => {
    const username = document.getElementById('username');
    const usernameError = document.getElementById('usernameError');
    const email = document.getElementById('email');
    const emailError = document.getElementById('emailError');
    const password = document.getElementById('password');
    const passwordError = document.getElementById('passwordError');
    const password2 = document.getElementById('password2');
    const password2Error = document.getElementById('password2Error');
    const flags = [];
    // return true;
    /* username */
    if (username.value.trim().length === 0) {
        usernameError.textContent = "JS username Can't be empty!";
        flags.push(false);
    } else {
        // return true;
        flags.push(true);
        usernameError.classList.toggle('success')
        usernameError.textContent = "JS no problem";
    }

    /**email */
    if (email.value.trim().length === 0) {
        emailError.textContent = "JS Email Can't be empty!";
        flags.push(false);
    } else if (!isEmail(email.value)) {
        emailError.textContent = "JS Wrong Email fromat";
        flags.push(false);
    } else {
        // return true;
        flags.push(true);
        emailError.textContent = "JS no problem";
    }

    /**password */
    if (password.value.length === 0) {
        passwordError.textContent = "JS Password can't be empty!";
        flags.push(false);
    } else if (password.value.length < 8) {
        passwordError.textContent = "JS Password must be at least 8 characters";
        flags.push(false);
    } else {
        passwordError.textContent = "JS no problem";
        flags.push(true);
    }


    /**password 2 */
    if (password2.value.length === 0) {
        password2Error.textContent = "JS Password 2 can't be empty!";
        flags.push(false);
    } else if (password2.value.length < 8) {
        password2Error.textContent = "JS Password must be at least 8 characters";
        flags.push(false);
    } else {
        password2Error.textContent = "JS no problem";
        flags.push(true);
    }

    if (password.value !== password2.value) {
        password2Error.textContent = "Password doesn't match!";
        flags.push(false);
    } else {
        password2Error.textContent = "JS no problem";
        flags.push(true);
    }

    flags.forEach(flag => {
        if (flag === false) {
            event.preventDefault();
            return false;
        }
    });
    return true;
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        .test(email);
}
</script>