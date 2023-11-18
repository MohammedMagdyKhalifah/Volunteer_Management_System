<?php
session_start();
include "./inc/config_db.php";
include "./parts/functons.php";
// if (!(isset($_SESSION['loggedin']))) {
//     header('location:./login_v.php');
// }
redirectToLoginIfNotLoggedIn();



include "./parts/class_user.php";
$user = new User($_SESSION["email"], $conn);



// بتاكد هل تحملت كل بيانات المسخدم
// echo print_r($user);
// echo $user->academic_id;

// بتأكد هل التوصيل صح مع قاعدة البيانات
// echo $_SESSION["email"] . " welcom";


// استيراد القيم بتاعة العمليات التطوعية
$sql = "SELECT * FROM volunteering WHERE availability>0";
// تخزين القيم 
$result = mysqli_query($conn, $sql);
// استجلاب للقيم
// ويخزنها على شكل مصفوفة
$volunteering = mysqli_fetch_all($result, MYSQLI_ASSOC);

// طباعة عشان اتاكد غير آمنة
// echo "<pre>";
// print_r($volunteering);
// echo "</pre>"; 

// class volunteering
// {

// }

// Handle the fucking submit
// بقالي اربع ساعات فيكي يابنت الكلب عشان اعمل لامك هاندل
handleVolunteeringRegistration($volunteering, $user, $conn);

if (isset($_POST['submit_logout'])) {
    log_out();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Home Page</title>
</head>

<body>
    <!-- start navbar -->
    <?php include './parts/v_home_navbar.php'; ?>
    <!-- end navbar -->

    <!-- start container -->
    <div class="container"> <!-- d-flex justify-content-between -->
        <?php include "./parts/Volunteering_cards.php"; ?>

    </div>

    <!-- End container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
<?php include './inc/close_db.php'; ?>