<?php
ob_start();
session_start();
if(isset($_SESSION['user'])){
    $tutor_id =$_SESSION['user'];
}else{
    $tutor_id = '';
    header('location:login.php');
}
include 'admin/init.php';
if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $msg = $_POST['msg'];
    $msg = filter_var($msg, FILTER_SANITIZE_STRING);

    $select_contact = $con->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND number = ? AND message = ?");
    $select_contact->execute([$name, $email, $number, $msg]);

    if($select_contact->rowCount() > 0){
        $message[] = 'message sent already!';
    }else{
        $insert_message = $con->prepare("INSERT INTO `contact`(name, email, number, message) VALUES(?,?,?,?)");
        $insert_message->execute([$name, $email, $number, $msg]);
        $message[] = 'message sent successfully!';
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="layout/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="layout/assets/img/favicon.png">
    <title>
        contact us <?php $title="contact"; ?>
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
    <style>
        /* Custom CSS for contact section */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .contact {
            padding: 50px 0;
        }
        .contact .row {
            align-items: center;
        }
        .contact .image img {
            width: 100%;
            max-width: 400px;
            height: auto;
            margin-bottom: 20px;
        }
        .contact form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .contact form h3 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .contact form .box {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .contact form .inline-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .box-container {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
        }
        .box {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .box i {
            font-size: 30px;
            color: #007bff;
            margin-bottom: 15px;
        }
        .box h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }
        .box a {
            display: block;
            color: #666;
            text-decoration: none;
        }
        .box a:hover {
            color: #007bff;
        }
    </style>
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">contact</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">contact</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Sign In</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Bootstrap JS and dependencies -->
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="image">
                        <img src="images/contact-img.svg" alt="Contact Image">
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="" method="post">
                        <h3>Get in Touch</h3>
                        <input type="text" name="name" class="box" placeholder="Enter your name" required>
                        <input type="email" name="email" class="box" placeholder="Enter your email" required>
                        <input type="tel" name="number" class="box" placeholder="Enter your number" required>
                        <textarea name="msg" class="box" placeholder="Enter your message" required></textarea>
                        <input type="submit" name="submit" value="Send Message" class="inline-btn">
                    </form>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row box-container">
                <div class="col-md-4">
                    <div class="box">
                        <i class="fas fa-phone"></i>
                        <h3>Phone Number</h3>
                        <a href="tel:1234567890">123-456-7890</a>
                        <a href="tel:1112223333">111-222-3333</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <i class="fas fa-envelope"></i>
                        <h3>Email Address</h3>
                        <a href="mailto:shaikhanas@gmail.com">shaikhanas@gmail.com</a>
                        <a href="mailto:anasbhai@gmail.com">anasbhai@gmail.com</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Office Address</h3>
                        <a href="#">Flat No. 1, A-1 Building, Jogeshwari, Mumbai, India - 400104</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <?php include "includes/template/footer.php";?>
