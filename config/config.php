<?php
// $_username = "mahdi";
// $_password = "123456";
$_servername = "localhost";
$_username = "root";
$_password = "";
$_dbname = "store";
try {
    $conn = new PDO("mysql:host=$_servername;dbname=$_dbname", $_username, $_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connection successful";
} catch (PDOException $e) {
    echo "connection failed" . $e->getMessage();
}
