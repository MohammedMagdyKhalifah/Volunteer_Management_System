<?php
    include "./../inc/config_db.php";
    include "./../parts/class_employee.php";
    session_start();
    include "./../parts/functons.php";
    if (!(isset($_SESSION['employee']))) {
        header('location: ./login_e.php');
    }
    $employee=unserialize($_SESSION['employee']);
    
    $sql = "SELECT * 
            FROM Volunteering 
            WHERE employee_id = $employee->id 
            AND availability > 0;";
    $result = mysqli_query($conn, $sql);
    $volunteering = mysqli_fetch_all($result, MYSQLI_ASSOC);

    function updateVolunteerHours($volunteering_id, $conn) {
        // 1: Get the hours for the specific volunteering_id
        $hoursSql = "SELECT hours FROM Volunteering WHERE id = $volunteering_id";
        $hoursResult = mysqli_query($conn, $hoursSql);
    
        if (!$hoursResult || mysqli_num_rows($hoursResult) == 0) {
            echo "Error or no data for the specified volunteering ID: " . mysqli_error($conn);
            return;
        }
    
        $hoursRow = mysqli_fetch_assoc($hoursResult);
        $volunteeringHours = $hoursRow['hours'];
    
        // 2: Get all volunteer_ids for the specific volunteering_id
        $volunteerIdsSql = "SELECT volunteer_id FROM Volunteering_details WHERE volunteering_id = $volunteering_id";
        $volunteerIdsResult = mysqli_query($conn, $volunteerIdsSql);

        if (!$volunteerIdsResult) {
            echo "Error retrieving volunteer ids: " . mysqli_error($conn);
            return;
        }
    
        // 3: Update volunteering_hours for each volunteer
        while ($row = mysqli_fetch_assoc($volunteerIdsResult)) {
            $volunteer_id = $row['volunteer_id'];
    
            // Update the volunteer table
            $updateSql = "UPDATE volunteer SET 	volunteering_hours = volunteering_hours + $volunteeringHours , number_v= number_v + 1 WHERE id = $volunteer_id";
            if (!mysqli_query($conn, $updateSql)) {
                echo "Error updating volunteer (ID: $volunteer_id): " . mysqli_error($conn);
            }
        }
    
        echo "Volunteer hours updated successfully.";
    }
    function handleVolunteeringCompleted($employee,$volunteering, $conn){
        foreach ($volunteering as $vo) {
            $volunteering_id = $vo["id"];
            // لو اتنيل بروح امه المستخدم وضغط على ام  التسجيل
            if (isset($_POST['completed_' . $volunteering_id])) {
                // echo "submit_".$volunteering_id;]
                // echo 'completed_' . $volunteering_id;
                // Add volunteer hours for every volunteer
                updateVolunteerHours($volunteering_id, $conn);
                $employee->completed_volunteering($volunteering_id, $conn);
            }
        }
    }
    handleVolunteeringCompleted($employee,$volunteering, $conn);
    
    

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