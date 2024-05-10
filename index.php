
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
            <li><a href="#">Home</a></li>
            <li><a href="#">Courses</a></li>
            <li><a href="#">Testimony</a></li>
            <li><a href="#">About Us</a></li>
        </ul>
        <ul class="buttons <?php if( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false ) echo "Hidden"; ?>">
            <li><a href="login.php">Login</a></li>
            <li><a  href="sign-in.php">join</a></li>
        </ul>
        <ul class="buttons <?php if(isset($_SESSION['loggedin'])&&  $_SESSION['loggedin'] == true ) echo "Hidden"; ?>">
            <li><a class="avatar" href="profile.php"><img src="./assets/img/image.png" alt=""></a></li>
        </ul>
        
    </nav>
</body>
</html>



