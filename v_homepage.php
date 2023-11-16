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
$sql = "SELECT * FROM volunteering";
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
include "./inc/close_db.php";
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
        <div id="volunteerings" class="row ">
            <?php foreach ($volunteering as $vo): ?>
                <!-- حيرجع كل واحد على شكل مصفوفة لوحده
                لما يخرج من قاعدة البيانات يخرج على شكل نص -->
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mb-4">
                    <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="card h-100" style="">
                            <img src="./img/Default_volunteering.jpg" class="card-img-top img-fluid" alt="image">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo htmlspecialchars($vo["title"]); ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo htmlspecialchars($vo["description"]); ?>
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <?php echo "Start Date : " . htmlspecialchars($vo["start_date"]); ?>
                                </li>
                                <li class="list-group-item">
                                    <?php echo "End Date : " . htmlspecialchars($vo["end_date"]); ?>
                                </li>
                                <li class="list-group-item">
                                    <?php echo "Volunteer Hours : " . htmlspecialchars($vo["hours"]); ?>
                                </li>
                                <li class="list-group-item">
                                    <?php echo "Required Skills : " . htmlspecialchars($vo["required_skills"]); ?>
                                </li>
                            </ul>
                            <button type="submit" name="submit_<?php echo htmlspecialchars($vo["id"]); ?>"
                                class="btn btn-primary m-2">register</button>
                        </div>
                    </form>

                </div>
                <?php endforeach ?>
            </div>
        
    </div>

    <!-- End container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>