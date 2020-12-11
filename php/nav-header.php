<?php
require_once '../php/api/config.inc.php';
require_once '../php/api/ASG2-classes.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ASG 2</title>
    <link rel="stylesheet" href="../css/nav.css">

</head>

<body>
    <header>
        <!-- Top Navigation Menu -->
        <div class="topnav">
            <a href="#home" class="active"></a>
            <!-- Navigation links (hidden by default) -->
            <ul id="myLinks">
                <li><a href="home.php"><img id="logo" src="../images/logo.jpg"></a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="galleries.php">Galleries</a></li>
                <li><a href="browse-paintings.php">Browse</a></li>
                <li><a class="logged-in" href="favorites.php">Favorites</a></li> <!-- only available when logged in -->
                <li><a class="logged-in" href="logout.php">Logout</a></li>
                <li><a class="logged-out" href="logout.php">Login</a></li>
            </ul>
            <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
            <li><a href="javascript:void(0);" class="icon" onclick="myFunction()"></li>
            <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>

</html>