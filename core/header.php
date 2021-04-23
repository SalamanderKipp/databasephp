<?php
    include('core/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop met een leuke naam</title>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img src="./assets/img/product.png"></a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mt-2">
                    <a href="index.php" type="button" class="btn btn-outline-warning mr-2">Home</a>
                </li>
                <li class="nav-item mt-2">
                    <a href="/webdev-base-webshop/admin" type="button" class="btn btn-outline-warning mr-2">Admin CRUD</a>
                </li>
                <li class="nav-item mt-2">
                    <a href="" type="button" class="btn btn-outline-warning mr-2">About</a>
                </li>
            </ul>
                <!-- checkt wat voor user je bent of ingelogt en laat nieuwe buttons zien -->
            <?php
            // if (isset($_SESSION['userType'])) {
            //     if ($_SESSION['userType'] == "admin") {
            //         echo '<a href="admin.php" type="button" class="btn btn-outline-warning mr-2 mt-2">Admin</a><br>';
            //         echo '<a type="button" href="myevents.php" class="btn btn-outline-warning mr-2 mt-2">My events</a><br>';
            //         echo '<a href="createEvent.php" type="button" class="btn btn-outline-warning mr-2 mt-2">Create Event</a>';
            //     }
            //     if ($_SESSION['userType'] == "member") {
            //         echo '<a type="button" href="myevents.php" class="btn btn-outline-warning mr-2 mt-2">My events</a><br>';
            //         echo '<a type="button" href="createEvent.php" class="btn btn-outline-warning mr-2 mt-2">Create Event</a>';
            //     }
            //     echo  '<a type="button" href="logout.php" class="btn btn-outline-warning mr-2">Log out</a>';
            
            // } else {
            //     echo '<a type="button" href="login.php" class="btn btn-outline-warning mr-2 mt-2">Login</a>
            //     <br>
            //         <a type="button" href="register.php" class="btn btn-outline-warning mr-2 mt-2">Register</a>';
            // }
            ?>
        </div>
</nav>