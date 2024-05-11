
<?php
session_start();
$_SESSION['loggedin'] = true;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../layout/css/main.css">
    <link rel="stylesheet" href="./layout/css/index.css">
    
    <title>Home</title>
</head>
<body>
    <nav class="nav">
        <h1 class="logo">CMS</h1>
        <ul class="pages">
            <li><a href="home.php">Home</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="#">Testimony</a></li>
            <li><a href="#">About Us</a></li>
        </ul>
        <ul class="buttons <?php if( isset($_SESSION['user']) && $_SESSION['user'] != '' ) echo "Hidden"; ?>">
            <li><a href="login.php">Login</a></li>
            <li><a  href="sign-in.php">join</a></li>
        </ul>
        <ul class="buttons <?php if(isset($_SESSION['user'])&&  $_SESSION['user'] == '' ) echo "Hidden"; ?>">
            <li><a class="avatar" href="profile.php"><img src="./assets/img/image.png" alt=""></a></li>
        </ul>
        
    </nav>
    <div class="container">
        <div class="hero-image">
            <img src="" alt="">
        </div>
        <div class="hero-text">
            <h3>Learn</h3>
            <h2>grow</h2>
            <h1>prosper</h1>
        </div>
    </div>
    <script src="./layout/js/index.js"></script>
</body>
</html>



