<?php
ob_start();
session_start();
if(isset($_SESSION['ID'])){
    $tutor_id =$_SESSION['ID'];
}else{
    $tutor_id = '';
    header('location:login.php');
}
include 'init.php';
if(isset($_GET['user_id'])&& isset($_GET['do'])){
    $user_id = $_GET['user_id'];
    $do=$_GET['do'];
    if($do=="Delete"){
        $delete_member = $con->prepare("DELETE FROM `users` WHERE UserID = ?");
        $delete_member->execute([$user_id]);
        header('location:member.php');
    }elseif ($do=="Edit"){
        if(isset($_POST['submit'])) {

            $username = $_POST['username'];
            $username = filter_var($username, FILTER_SANITIZE_STRING);
            $email = $_POST['email'];
            $description = filter_var($email, FILTER_SANITIZE_STRING);
            $status = $_POST['Group_id'];
            $status = filter_var($status, FILTER_SANITIZE_STRING);
            $password = $_POST['password'];;
            $password = filter_var($password, FILTER_SANITIZE_STRING);
            $password=sha1($password);
            $fullname = $_POST['fullname'];;
            $fullname = filter_var($fullname, FILTER_SANITIZE_STRING);
            $update = $con->prepare("UPDATE `users` SET Username = ?,Email=?,FullName=?,Password=?,GroupID=? WHERE UserID = ?");
            $update->execute([$username, $email, $fullname, $password, $status, $_GET['user_id'] ]);
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
            Member <?php $title="member"; ?>
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
        <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
        <style>
            /* Custom styles for form */
            .form-container {
                max-width: 500px;
                margin: auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 8px;
                background-color: #f8f9fa;
            }

            .form-control {
                margin-bottom: 20px;
            }

            .form-control label {
                font-weight: bold;
            }

            .form-control span {
                color: red;
            }

            .btn-primary {
                width: 100%;
                padding: 12px;
                font-size: 16px;
            }
        </style>

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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Member</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Update Member</h6>
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
        <div class="container mt-5">
            <div class="form-container">
                <h2 class="text-center mb-4">Update Member</h2>
                <?php
                $select_member = $con->prepare("SELECT * FROM `users` WHERE UserID = ? ");
                $select_member->execute([$_GET['user_id']]);
                if($select_member->rowCount() > 0){
                    while($fecth_member= $select_member->fetch(PDO::FETCH_ASSOC)){
                        $member_id = $fecth_member['UserID'];
                        $member_username = $fecth_member['Username'];
                        $member_Email = $fecth_member['Email'];
                        $member_Fullname = $fecth_member['FullName'];
                        $member_status = $fecth_member['GroupID'];
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- member username -->
                            <div class="mb-3">
                                <label for="Username" class="form-label">Username <span>*</span></label>
                                <input type="text" name="username" id="Username" value="<?= $member_username; ?>" class="form-control" maxlength="100" required placeholder="Enter Username">
                            </div>

                            <!-- member Emali -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span>*</span></label>
                                <input type="email" name="email" id="email" value="<?= $member_Email; ?>" class="form-control" maxlength="100" required placeholder="Enter Email">
                            </div>

                            <!-- member FullName -->
                            <div class="mb-3">
                                <label for="FullName" class="form-label">FullName <span>*</span></label>
                                <input type="text" name="fullname" id="email" value="<?= $member_Fullname; ?>" class="form-control" maxlength="100" required placeholder="Enter FullName">
                            </div>
                            <!-- member FullName -->
                            <div class="mb-3">
                                <label for="password" class="form-label">password <span>*</span></label>
                                <input type="password" name="password" id="password" value="" class="form-control" maxlength="100" required placeholder="Enter password">
                            </div>
                            <!-- member Group_id -->
                            <div class="mb-3">
                                <label for="Group_id" class="form-label">Group_id <span>*</span></label>
                                <select name="Group_id" id="Group_id" class="form-select" required>
                                    <option value="0" <?= $member_status == '0' ? 'selected' : ''; ?>>0</option>
                                    <option value="1" <?= $member_status == '1' ? 'selected' : ''; ?>>1</option>
                                </select>
                            </div>


                            <!-- Submit Button -->
                            <div class="mb-3">
                                <input type="submit" value="Update " name="submit" class="btn btn-primary">
                            </div>

                        </form>
                        <?php
                    }
                }
                ?>
            </div>
        </div>


        <?php include "includes/template/footer.php";?>
    </body>

<?php    }
}else{
    header('location:member.php');
}

