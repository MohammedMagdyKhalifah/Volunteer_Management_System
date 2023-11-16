<?php
    include "./parts/class_user.php";
    
    include './inc/config.php';
    session_start();
    
    
    
    if (!(isset($_SESSION['email']))) {
        header('location:./login_v.php');
    }
    $user = unserialize($_SESSION["user"]);
    print_r($user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>
    <?php include "./parts/v_account_navbar.php" ?>
    <div class="container mt-5">
            <h1>Edit Profile</h1>
            <form>
                <!-- Name field -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" value="">
                </div>

                <!-- Email field -->
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" value="youremail@example.com">
                </div>

                <!-- Address field -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St" value="1234 Main St">
                </div>

                <!-- City field -->
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" placeholder="City" value="Your City">
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>