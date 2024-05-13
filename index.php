
<?php
session_start();
$_SESSION['loggedin'] = true;

if (isset($_SESSION['username']))
{
    echo $_SESSION['username'];
}

include'admin/connect.php';
include'include/functions/functions.php';



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
        <div class="pages-logo">
        <h1 class="logo">CMS</h1>
        <ul class="pages">
            <li><a href="home.php">Home</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="#">Testimony</a></li>
            <li><a href="#">About Us</a></li>
        </ul>
        </div>
        <ul class="buttons <?php if( isset($_SESSION['username']) && $_SESSION['username'] != '' ) echo "Hidden"; ?>">
            <li><a href="login.php">Login</a></li>
            <li><a  href="Sign-up.php">join</a></li>
        </ul>
        

        <ul class="profile <?php if(!isset($_SESSION['username'])||  $_SESSION['username'] == '' ) echo "Hidden"; ?>">
            <li><p><?php echo $_SESSION['username']?></p></li>

            <?php 

                $profilePic = ".assets/img/image.png";
            ?>
            <li><a class="avatar" href="profile.php"><img src="<?php echo $_SESSION['profilePic']; ?>" alt=""></a></li>

        </ul> 
        
    </nav>
    <div class="container">
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1616400619175-5beda3a17896?q=80&w=1674&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
        </div>
        <div class="hero-text">
            <div class="quotes">
            <h3>Learn</h3>
            <h2>grow</h2>
            <h1>prosper</h1>
            </div>
            
        </div>
    </div>
    <script src="./layout/js/index.js"></script>
</body>
</html>



