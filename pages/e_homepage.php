<?php
    include "./../inc/config_db.php";
    include "./../parts/class_employee.php";
    session_start();
    include "./../parts/functons.php";
    if (!(isset($_SESSION['employee']))) {
        header('location:./login_e.php');
    }
    $employee=unserialize($_SESSION['employee']);
    
    $sql = "SELECT * 
            FROM Volunteering 
            WHERE employee_id = $employee->id 
            AND availability > 0;";
    $result = mysqli_query($conn, $sql);
    $volunteering = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include "./../parts/e_home_navbar.php" ?>
    <div class="container">
        <?php include "./../parts/Volunteering_e_cards.php"; ?>
    </div>
</body>
</html>
<?php include "./../inc/close_db.php"; ?>