<?php
    include "./../inc/config_db.php";
    include "./../parts/class_employee.php";
    session_start();
    if (!(isset($_SESSION['employee']))) {
        header('location:./login_e.php');
    }
    // $employee = unserialize($_SESSION["employee"]);
    echo $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h2>hello Employee</h2>
</body>
</html>