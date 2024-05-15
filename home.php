<?php 
session_start();
include'admin/connect.php';
include'includes/functions/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="layout/assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="layout/assets/img/favicon.png">
        <title>
        Home <?php $title="home"; ?>
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
        <?php include 'includes/template/header.php'?>
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
                        <?php include 'includes/template/Nav.php'?>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->

            <div class="container-fluid py-4">
                <div class="row">


                
        
            
            <!-- Playlist Items -->
            <?php
                $select_playlist = $con->prepare("SELECT * FROM `playlist`");
                $select_playlist->execute();
                if($select_playlist->rowCount() > 0){
                    while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
                        $playlist_id = $fetch_playlist['id'];
                        $count_videos = $con->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
                        $count_videos->execute([$playlist_id]);
                        $total_videos = $count_videos->rowCount();
                        ?>
                       
                       <div class="col-lg-5 col-md-3 mb-md-0 mb-4 ">
                        <div class="card p-2">
                        <div class="row">
                                        <div class="col-3"> <i class=" fas fa-circle me-2 text-success"></i><span class="text-success"><?= $fetch_playlist['status']; ?></span></div>
                                        <div class="col-4"><i class="fas fa-calendar me-2"></i><span><?= $fetch_playlist['date']; ?></span></div>
                                        <span class="col-3 badge bg-secondary"><?= $total_videos; ?> Videos</span>
                                    </div>
                        <div class="thumb row">
                                    
                                    <img style=" object-fit: cover; height: 200px; aspect-ratio: 1/1;" "draggable="false" src="uploaded_files/<?= $fetch_playlist['image']; ?>" class="img-fluid course-image">
                                </div>


                                <div  class="course-details">
                                    
                                    
                                    <div class="course-text">
                                    <h3 class="title mt-3"><?= $fetch_playlist['title']; ?></h3>
                                    <p class="description"><?= $fetch_playlist['description']; ?></p>
                                    <button>View</button>    
                                    </div>
                                </div>
                                
                                
                                <!-- Delete Playlist Form -->
                        </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-md-4"><div class="box"><p class="empty">No playlist added yet!</p></div></div>';
                }
                ?>
            


        
                    
                        
                    </div>
                </div>
                
            
            </div>
        </body>