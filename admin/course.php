<?php
ob_start();
session_start();
if(isset($_SESSION['ID'] )){
    $tutor_id =$_SESSION['ID'] ;
}else{
    $tutor_id = '';
    header('location:index.php');
}
include 'init.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="layout/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="layout/assets/img/favicon.png">
    <title>
        member <?php $title="course"; ?>
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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Courses</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Courses</h6>
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
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Courses table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Instractors</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Completion</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $select_course = $con->prepare("SELECT * FROM `playlist`");
                                $select_course->execute();
                                if($select_course->rowCount() > 0){
                                while($fetch_course = $select_course->fetch(PDO::FETCH_ASSOC)){
                                $course_id = $fetch_course['id'];
                                $course_name = $fetch_course['title'];
                                $member_id = $fetch_course['user_id'];
                                $date= $fetch_course['date'];
                                $member_status = $fetch_course['status'];
                                $select_member = $con->prepare("SELECT Username FROM `users` WHERE  UserID= ?");
                                $select_member->execute([$member_id]);
                                if($select_member->rowCount() > 0){
                                    while($fetch_member = $select_member->fetch(PDO::FETCH_ASSOC)){
                                        $member_name = $fetch_member['Username'];
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div>
                                                <img src="../uploaded_files/<?=$fetch_course['image'];?>" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                            </div>
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-sm"><?= $course_name;?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?= $date?></p>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold"><?= $member_name;?></span><?php }}?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="me-2 text-xs font-weight-bold"><?= random_int(10,90); ?>%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= random_int(10,90); ?>%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href='update_course.php?do=Delete& course_id=<?=$course_id; ?>' class='btn btn-danger btn-sm confirm'><i class='fas fa-trash-alt'></i></a>
                                    </td>
                                </tr>
                                <?php }
                                }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include "includes/template/footer.php";?>
</body>