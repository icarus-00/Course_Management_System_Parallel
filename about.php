<?php
ob_start();
session_start();
if (isset($_SESSION['$profilePic'])) echo $_SESSION['$profilePic'];
if(isset($_SESSION['user'])){
    $tutor_id =$_SESSION['user'];
}else{
    $tutor_id = '';
    header('location:login.php');
}
include 'admin/init.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="layout/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="layout/assets/img/favicon.png">
    <title>
        about <?php $title="about"; ?>
    </title>
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
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <style>
        /* Custom CSS for about and reviews sections */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .about, .reviews {
            padding: 50px 0;
        }
        .about .row, .reviews .box-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .about .image, .reviews .box {
            flex: 0 0 45%;
            margin-bottom: 30px;
        }
        .about .image img {
            width: 100%;
            border-radius: 10px;
        }
        .about .content h3, .reviews .box p {
            margin-bottom: 20px;
        }
        .reviews .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .reviews .box p {
            font-size: 16px;
            line-height: 1.6;
        }
        .reviews .user {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .reviews .user img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .reviews .stars {
            color: #ffc107;
        }
        .box-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }
        .box i {
            font-size: 36px;
            color: #007bff; /* Blue color */
        }
        .box h3 {
            font-size: 24px;
            margin-top: 10px;
        }
        .box span {
            font-size: 18px;
            color: #666;
        }
    </style>
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<body class="g-sidenav-show  bg-gray-100">
<?php include 'includes/template/navbar.php'?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">about us</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Team</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
                <?php include 'includes/template/Nav.php'?>
                

        </div>
    </nav>
    <!-- About Section -->
    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 image">
                    <img src="images/svgs/landing2.svg" alt="About Image">
                </div>
                <div class="col-md-6 content">
                    <h3>Why?</h3>
                    <p>becaue we belive that a better world starts with sharing experiences.</p>
                    <a href="home.php" class="btn btn-primary">Our Courses</a>
                </div>
            </div>
        </div>
        <div class="box-container">
        <!-- Statistics Boxes -->
        <div class="box">
        <i class="fas fa-user"></i>
            <div>
                <h3>focus</h3>
                <span>users</span>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-user-graduate"></i>
            <div>
                <h3>one branch</h3>
                <span>For all</span>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-chalkboard-user"></i>
            <div>
                <h3>+A chance</h3>
                <span>To prosper</span>
            </div>
        </div>

       
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews">
        <div class="container">
            <h1 class="heading">The project is Open Source!</h1>
            <div >
                <!-- Review Box 1 -->
                <div style="width: 100% !important;" class="box">
                    
                    <div class="user">
                        <img style="width: 200px !important; aspect-ratio:1/1 !important; height:auto !important; " style="cursor: pointer;"  onclick="location.href='https://github.com/icarus-00/Course_Management_System_Parallel' " src="images/svgs/GitHub-Logo.wine.svg" alt="User Image">
                        <div>
                            <h3>Git Reposistory</h3> 
                            <h1>Wanna contribute?</h1>
                            
                        </div>
                    </div>
                    <p>To Achieve what we believe, we know that we can't do it alone, and if we would,</p> 
                    <p>we would not be able to, but non can profit with us.</p>
                </div>
                <!-- Review Box 2 -->
                
                <!-- Additional Review Boxes... -->
            </div>
        </div>
    </section>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <?php include "includes/template/footer.php";?>
