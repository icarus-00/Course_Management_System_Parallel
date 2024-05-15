
<?php
session_start();

include'admin/connect.php';
include'includes/functions/functions.php';


$pic ='';

if (isset($_SESSION['username']) && $_SESSION['username'] != '') 
{
    $pic = getUserImage('UserID = ' . $_SESSION['user']);
}









if ($pic != NULL || $pic != '')
{
    $_SESSION['profilePic'] = $pic;
}
else 
{
    $pic = "/assets/userImages/DefualtUser.png";
    $_SESSION['profilePic'] = $pic;
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../layout/css/main.css">
    <link rel="stylesheet" href="./layout/css/index.css">
     <!--     Fonts and icons     -->
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="layout/assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="layout/assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="layout/assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="layout/assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />

    
    
    <title>Home</title>
</head>
<body>
    <?php include 'includes/template/navhome.php'?>
    <div class="container-l">
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



