<?php
include "./../inc/config_db.php";
include "./../parts/class_employee.php";
session_start();
include "./../parts/functons.php";
if (!(isset($_SESSION['volunteering_id']))) {
    header('location: ./login_e.php');
}
$employee = unserialize($_SESSION['employee']);
$volunteering_id = $_SESSION['volunteering_id'];
// echo $volunteering_id;
function getVolunteeringName($volunteering_id, $conn)
{
    $sql = "SELECT title FROM Volunteering WHERE id = $volunteering_id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC)[0]["title"];
}
$volunteering_name = getVolunteeringName($volunteering_id, $conn);
function getAllVolunteers($volunteering_id, $conn){

    $sql = "SELECT volunteer.id, volunteer.name, volunteer.phone,volunteer.academic_id, volunteer.skills, volunteer.rates
            FROM volunteer
            INNER JOIN Volunteering_details ON volunteer.id = Volunteering_details.volunteer_id
            WHERE Volunteering_details.volunteering_id = $volunteering_id; ";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
$volunteers = getAllVolunteers($volunteering_id,$conn);


// if he saved
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['save'])){
        // لو كان مقيهم قبل كدا
        $sql2 = "SELECT is_rated FROM Volunteering WHERE id=$volunteering_id AND is_rated>0 ;";
        $result = mysqli_query($conn,$sql2);
        if (mysqli_num_rows($result) > 0) {
            echo '<script type=text/javascript> alert("You have Rated this Volunteering opportunity before!");window.location.href=window.location.href;</script>';
        }else{
            foreach($volunteers as $volunteer){
                $rate = $_POST['rate_'.htmlspecialchars($volunteer['id'])];
                // echo $volunteer['name'].$rate;
                $id = $volunteer["id"];
                $sql = "UPDATE volunteer
                SET rates = rates + $rate
                WHERE `volunteer`.`id` = $id ;";
                if(!mysqli_query($conn,$sql)){
                    echo "error in updating rate".mysqli_error($conn);
                }
            }
            $sql3 = "UPDATE Volunteering SET is_rated=1 WHERE id=$volunteering_id";
            if(!mysqli_query($conn,$sql3)){
                echo "error and updating is_rated".mysqli_error($conn);
            }
            echo '<script type=text/javascript> alert("You have Successfully Rated this Volunteering opportunity!");window.location.href=window.location.href;</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View & Rate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include "./../parts/e_home_navbar.php"; ?>
    <div class="container position-relative">
        <h1 class="mb-3">View & Rate</h1>
        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <h3 class="">
                <?php echo $volunteering_name; ?>
            </h3>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Skills</th>
                        <th scope="col">Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter =1; ?>
                    <?php foreach($volunteers as $volunteer) : ?>
                    <tr>
                        <th scope="row"><?php echo $counter; ?></th>
                        <th><?php echo htmlspecialchars($volunteer['academic_id']); ?></th>
                        <td><?php echo htmlspecialchars($volunteer['name']); ?></td>
                        <td><?php echo 0 . htmlspecialchars($volunteer['phone']); ?></td>
                        <td><?php echo htmlspecialchars($volunteer['skills']); ?></td>
                        <td><input type="range" class="form-range " min="0" max="10" step="0.5" value="<?php if($volunteer['rate']!=null) echo htmlspecialchars($volunteer['rate']); else{echo 10;}?>" id="customRange3"
                        name="rate_<?php echo htmlspecialchars($volunteer['id']) ?>"></td>
                    </tr>
                    <?php $counter++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
            
        </form>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>

<?php include "./../inc/close_db.php"; ?>