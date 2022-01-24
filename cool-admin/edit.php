<?php
session_start();
// echo $_POST['hidden-user-id-from-admin'];
// echo "<br/> url id = " . $_GET['id'];
// $user_id = $_POST['hidden-user-id-from-admin'];


$user_id = "";

if (isset($_GET['hidden-user-id-from-admin'])) {
    $_SESSION['edit-user'] = $_GET['hidden-user-id-from-admin'];
    $user_id = $_SESSION['edit-user'];
    // echo $_SESSION['edit-user'];
    // echo "h1 ";
} else {
    $_GET['hidden-user-id-from-admin'] = $_SESSION['edit-user'];
    $user_id = $_SESSION['edit-user'];
    // echo "h2 ";
    // echo $_SESSION['edit-user'];
}
echo "<br/>user_id = $user_id <br/>";
require('../config/config.php');

try {
    $_command = "SELECT * FROM users WHERE id = $user_id";
    $_statement = $conn->prepare("$_command");
    $_statement->execute();
    $user = $_statement->fetch(PDO::FETCH_ASSOC); # get single user
    // $user = $_statement->fetchAll();
    foreach ($user as $k => $v) {
        echo "key = $k, value =  $v <br/>";
        // $user = $v;
    }
} catch (PDOException $e) {
    // echo "Connection error" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <title>admin - edit user</title>
</head>

<body>
    <?php
    if (isset($_POST['submit-edit-user'])) {
        function_alert("submit pressed");

        $id = $_POST['id-edit'];
        $username = trimInput($_POST['username-edit']);
        $email = trimInput($_POST['email-edit']);
        $password = $_POST['password-edit'];
        $is_admin = trimInput($_POST['is_admin-edit']);

        echo $id, $username, $email, $password, $is_admin;

        // $usernameFlag = $emailFlag = $passwordFlag = $is_adminFlag = true;
        // $usernameError = $emailError = $passwordError = $is_adminError = null;

        #if all is good
        // if ($usernameFlag === true && $emailFlag === true && $passwordFlag === true && $is_adminFlag === true) {
        #try to insert user into database
        // function_alert("inside of if");
        try {
            $_command = "UPDATE users SET username ='$username', email='$email', password='$password', is_admin='$is_admin' WHERE id = $id;";
            // $_command = "UPDATE users SET username ='test', email='test', password='test', is_admin='1' WHERE id = $id;";
            $stmt = $conn->prepare($_command);
            $result = $stmt->execute();
            if ($result) {
                echo "New record created successfully";
                function_alert("edit was successful");
            } else {
                echo "Operation failed";
                function_alert("Operation failed");
            }
            // header("Location: ./index.php");
        } catch (PDOException $e) {
            #email duplicate
            $emailError = "php error: email already exist";
        }
        // }
    }

    function trimInput($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function function_alert($message)
    {
        // Display the alert box 
        echo "<script>alert('$message');</script>";
    }
    ?>
    <div class="wrapper">
        <table class="table table-striped m-1">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                    <th scope="col">password</th>
                    <th scope="col">is_admin</th>
                    <th scope="col">submit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                        <th scope="row">
                            <input type="text" class="form-control" name="id-edit" value="<?php echo $user['id'] ?>" readonly>
                        </th>
                        <td>
                            <input type="text" class="form-control" name="username-edit" value="<?php echo $user['username'] ?>">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="email-edit" value="<?php echo $user['email'] ?>">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="password-edit" value="<?php echo $user['password'] ?>">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="is_admin-edit" value="<?php echo $user['is_admin'] ?>">
                        </td>
                        <td>
                            <input type="submit" value="Submit changes" name="submit-edit-user" class="btn btn btn-primary">
                        </td>
                    </form>

                </tr>
                <tr>
                    <th>#</th>
                    <td><?php echo isset($usernameError) ? $usernameError : ""; ?></td>
                    <td><?php echo isset($emailError) ? $emailError : ""; ?></td>
                    <td><?php echo isset($passwordError) ? $passwordError : ""; ?></td>
                    <td><?php echo isset($is_adminError) ? $is_adminError : ""; ?></td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>