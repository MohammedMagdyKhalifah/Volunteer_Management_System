<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>


    <!-- Header navbar Section -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://www.taibahu.edu.sa/Pages/AR/Home.aspx">
                <img src="./img/logo.png" alt="Logo" style="height: 7vh;">
            </a>
            <!-- زرار الاختيارات للشاشات الصغيرة -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex">
                    <!-- Volunteer Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="volunteerDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Volunteer
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="volunteerDropdown">
                            <li><a class="dropdown-item" href="#">Login</a></li>
                            <li><a class="dropdown-item" href="#">Register</a></li>
                        </ul>
                    </li>
                    <!-- Employee Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="employeeDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Employee
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="employeeDropdown">
                            <li><a class="dropdown-item" href="#">Login</a></li>
                            <li><a class="dropdown-item" href="#">Register</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Introduction Section -->
    <section class="py-5">
        <div class="containerr">
            <h1 class="">Welcome to Volunteering</h1>
            <div>
                <h3>What is Volunteering?</h2>
                <p class="lead">Your one-stop platform to manage and participate in volunteering activities.</p>
            </div>

        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="https://www.taibahu.edu.sa/Pages/AR/Home.aspx">
                        <img src="./img/logo.png" alt="Footer Logo" style="height: 7vh;">
                    </a>
                    <p class="mt-2">Your volunteering makes a difference.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><i class="fas fa-phone-alt"></i> +966 148 61 8888</p>
                    <p><i class="fas fa-map-marker-alt"></i> FGPR+CVM, Janadah Bin Umayyah Road, Taiba, Medina 42353
                    </p>
                    <!-- Social Media Icons -->
                    <a href="https://www.youtube.com/universityoftaibah" class="text-white me-2"><i
                            class="fab fa-youtube"></i></a>
                    <a href="https://twitter.com/taibahu" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/taibah_uni/" class="text-white me-2"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>