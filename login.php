<?php
session_start();

$_servername = "localhost";
$_username = "mahdi";
$_password = "123456";
$_dbname = "store";
try {
    $conn = new PDO("mysql:host=$_servername;dbname=$_dbname", $_username, $_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    # echo "connection successful";

    // $_command = "SELECT * FROM users;";
    // $statement = $conn->prepare("$_command");
    // $statement->execute();
    // $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
    // $users = $statement->fetchAll(); #get all users
    // foreach (new RecursiveArrayIterator($users) as $k => $v) {
    //     #echo
    // }
} catch (PDOException $e) {
    echo "connection failed" . $e->getMessage();
}
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
    <?php
    $email = $password = "";
    $emailError = $passwordError = "";
    $passwordFlag = $emailFlag = false;
    $_SESSION['loggedUser'] = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST['email'])) {
            $emailError = "PHP Email is required";
        } else {
            $email = trimInput($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "PHP Invalid Email format";
                $email = "";
            } else {
                $email = trimInput($_POST['email']);
                $emailFlag = true;
            }
        }

        if (empty($_POST['password'])) {
            $passwordError = "PHP Password is required";
        } elseif (strlen($_POST['password']) < 8) {
            $passwordError = "'PHP 'Password can't be less than 8 charaters";
        } else {
            $password = $_POST['password'];
            $passwordFlag = true;
        }
        # echo "$emailFlag & $passwordFlag";
        if ($emailFlag === true && $passwordFlag === true) {

            $stmt = $conn->prepare("SELECT * FROM users WHERE email= '$email' and password='$password'");
            $stmt->execute();

            // set the resulting array to associative
            $rslt = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rslt = $stmt->fetchAll();
            if ($rslt[0]['email'] == $email && $rslt[0]['password'] == $password) {
                $_SESSION['loggedUser'] = $rslt[0];
                if ($rslt[0]['is_admin'] == true) {
                    header("Location: ./cool-admin/");
                } else {
                    header("Location: ./welcome.php");
                }
            } else {
                $passwordError = "invalid credintials";
            }

            # old code
            // foreach ($users as $key => $user) {
            //     if ($user['email'] == $email) {
            //         $_SESSION['loggedUser'] = $user;
            //     }
            // }
            // header("Location: ./welcome.php");
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
                    <img src="https://colorlib.com/etc/lf/Login_v1/images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    method="POST" onsubmit=" validateForm(event)">
                    <span class="login100-form-title">
                        Member Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" id="email" type="text" name="email" placeholder="Email">
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
                    </div>
                    <span class="error" id="emailError"></span>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" id="password" type="text" name="password" placeholder="Password">
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

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
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
                        <a class="txt2" href="./register.php">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
const validateForm = (event) => {
    const email = document.getElementById('email');
    const emailError = document.getElementById('emailError');
    const password = document.getElementById('password');
    const passwordError = document.getElementById('passwordError');
    const flags = [];
    // return true;
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

</html>