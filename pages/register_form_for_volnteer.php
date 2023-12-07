<?php
include "./../inc/config_db.php";
$errors = [
    'NameError' => '',
    'EmailError' => '',
    'PasswordError' => '',
    'PasswordError2' => '',
    'PhoneNumberError' => '',
    'AddressError' => '',
    'AcademicIdError' => '',
    'SkillsError' => '',
    'AvailableError' => '',
];
if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = MD5(mysqli_real_escape_string($conn, $_POST['password']));
    $password2 = MD5(mysqli_real_escape_string($conn, $_POST['password2']));
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $available = $_POST['option'] == "available" ? 1 : 0;
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $academic_id = mysqli_real_escape_string($conn, $_POST['academic_id']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);

    if(empty($name)) {
        $errors['NameError'] = 'Enter Your Name';
    }
    if(empty($academic_id)) {
        $errors['AcademicIdError'] = 'Enter Your Academic Id';
    }
    if(empty($email)) {
        $errors['EmailError'] = 'Enter Your Email';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['EmailError'] = 'Enter A Valid Email';
    }
    if(empty($address)) {
        $errors['AddressError'] = 'Enter Your Address';
    }
    if(empty($skills)) {
        $errors['SkillsError'] = 'Enter Your Skills';
    }
    if(empty($available)) {
        $errors['AvailableError'] = 'Choose Your Availabilty';
    }
    if(empty($password)) {
        $errors['PasswordError'] = 'Enter A Password';
    }
    if(empty($password2)) {
        $errors['PasswordError2'] = 'Enter A Confirm Password';
    }
    if(empty($phoneNumber)) {
        $errors['PhoneNumberError'] = 'Enter A Phone Number';
    }
    if($password != $password2) {
        echo 'Password not Matched !';
    }
    if((!empty($name)) && (!empty($email)) && (filter_var($email, FILTER_VALIDATE_EMAIL)) && (!empty($password)) && (!empty($password2)) && (!empty($phoneNumber)) && ($password == $password2) && (!empty($address)) && (!empty($academic_id)) && (!empty($skills))) {
        $sql = "INSERT INTO `volunteer` (`name`, `email`, `password`, `phone`, `volunteering_hours`, `academic_id`, `address`, `skills`, `availability`, `number_v`, `rates`)
        VALUES ('$name', '$email', '$password', '$phoneNumber', 0, '$academic_id', '$address', '$skills', '$available', 0, 0)";
        if(mysqli_query($conn, $sql)) {
            header("Location: ./login_v.php");
            exit;
        } else {
            echo "Error in Create account".mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Register page</title>
</head>

<body class="bg-light">

    <div class="container mt-3 mb-3">
        <h1> Register Volunteer Page </h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>" id="name" required>
                <div id="emailHelp" class="form-text error">
                    <?php echo $errors['NameError'] ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="academic_id" class="form-label">Academic ID</label>
                <input type="text" class="form-control" name="academic_id" value="<?php echo $academic_id ?>"
                    id="academic_id" required>
                <div id="emailHelp" class="form-text error">
                    <?php echo $errors['AcademicIdError'] ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email ?>" id="email" required>
                <div id="emailHelp" class="form-text error">
                    <?php echo $errors['EmailError'] ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label"> Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo $address ?>" id="address"
                    required>
                <div id="emailHelp" class="form-text error">
                    <?php echo $errors['AddressError'] ?>
                </div>
            </div>


            <div class="mb-3">
                <label for="address" class="form-label"> Skills</label>
                <input type="text" class="form-control" name="skills" value="<?php echo $skills ?>" id="skills"
                    required>
                <div id="emailHelp" class="form-text error">
                    <?php echo $errors['SkillsError'] ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <div id="emailHelp" class="form-text error">
                    <?php echo $errors['PasswordError'] ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="password2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password2" id="password2" required>
                <div id="emailHelp" class="form-text error">
                    <?php echo $errors['PasswordError2'] ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phoneNumber" value="<?php echo $phoneNumber ?>"
                    id="phoneNumber" required>
                <div id="emailHelp" class="form-text error">
                    <?php echo $errors['PhoneNumberError'] ?>
                </div>
            </div>

            <!-- Availability -->
            <div class="mb-3">
                <label><strong>Availability</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" id="Radio_Available" value="available"
                        checked>
                    <label class="form-check-label" for="Radio_Available">
                        Available
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" id="Radio_Not_available"
                        value="Not available">
                    <label class="form-check-label" for="Radio_Not_available">
                        Not available
                    </label>
                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>

</html>
<?php include "./../inc/close_db.php"; ?>