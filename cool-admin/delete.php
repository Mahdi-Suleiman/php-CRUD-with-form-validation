<?php
require("../config/config.php");

$user_id = "";

if (isset($_GET['hidden-user-id-from-admin'])) {
    $_SESSION['edit-user'] = $_GET['hidden-user-id-from-admin'];
    $user_id = $_SESSION['edit-user'];
} else {
    $_GET['hidden-user-id-from-admin'] = $_SESSION['edit-user'];
    $user_id = $_SESSION['edit-user'];
}

try {
    // $_command = "UPDATE users SET username ='$username', email='$email', password='$password', is_admin='$is_admin' WHERE id = $id;";
    // $_command = "UPDATE users SET username ='test', email='test', password='test', is_admin='1' WHERE id = $id;";
    $_command = "DELETE FROM users WHERE id = $user_id";
    $stmt = $conn->prepare($_command);
    $result = $stmt->execute();
    if ($result) {
        echo "record deleted successfully";
        function_alert("deleted successfully");
        header("Location: ./index.php");
    } else {
        echo "delete failed";
    }
} catch (PDOException $e) {
    echo "error" . $e->getMessage();
}

function function_alert($message)
{
    // Display the alert box 
    echo "<script>alert('$message');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>