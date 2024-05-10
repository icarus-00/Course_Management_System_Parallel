<?php
ob_start();
session_start();
if(isset($_COOKIE['user'])){
    $tutor_id = $_COOKIE['user'];
}else{
    $tutor_id = '';
    header('location:login.php');
}
if(isset($_GET['get_id'])){
    $get_id = $_GET['get_id'];
}else{
    $get_id = '';
    header('location:playlist.php');
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
        Play lists <?php $title="playlists"; ?>
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
        /* Custom styles for video container */
        .video-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-top: 56.25%; /* 16:9 aspect ratio (responsive video) */
            margin-bottom: 20px;
            overflow: hidden;
        }

        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .date {
            color: #6c757d;
            margin-bottom: 10px;
        }

        .title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .flex {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .flex div {
            margin-right: 20px;
        }

        .description {
            color: #343a40;
            margin-bottom: 20px;
        }

        .empty {
            margin-top: 20px;
            font-style: italic;
            color: #6c757d;
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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">play Lists</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Play Lists</h6>
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
    <section class="view-content">
        <?php
        $select_content = $con->prepare("SELECT * FROM `content` WHERE id = ? AND user_id = ?");
        $select_content->execute([$get_id, $tutor_id]);
        if($select_content->rowCount() > 0){
            while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){
                $video_id = $fetch_content['id'];
                ?>
                <div class="container">
                    <div class="video-container">
                        <videp id="videoPlayer<?= $video_id; ?>" s class="video" controls poster="uploaded_files/<?= $fetch_content['image']; ?>">
                            <source src="https://www.youtube.com/watch?v=1itG8q-sCGY&list=PLs3IFJPw3G9IiHm9PEP1UaMtuvACmxVMj" type="video/youtube">
                            <!-- Fallback content in case the video source is not supported -->
                            Your browser does not support the video tag.
                        </videp>
                    </div>
                    <div class="date"><i class="fas fa-calendar"></i> <?= $fetch_content['date']; ?></div>
                    <h3 class="title"><?= $fetch_content['title']; ?></h3>
                    <div class="flex">
                        <div><i class="fas fa-heart"></i> 1</div>
                        <div><i class="fas fa-comment"></i> 1</div>
                    </div>
                    <div class="description"><?= $fetch_content['description']; ?></div>
                    <form action="" method="post">
                        <div class="flex-btn">
                            <input type="hidden" name="video_id" value="<?= $video_id; ?>">
                            <a href="update_content.php?get_id=<?= $video_id; ?>" class="btn btn-primary">Update</a>
                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Delete this video?');" name="delete_video">
                        </div>
                    </form>
                </div>
                <?php
            }
        }else{
            echo '<p class="empty">No contents added yet! <a href="add_content.php" class="btn btn-primary mt-3">Add Videos</a></p>';
        }
        ?>
    </section>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <?php include "includes/template/footer.php";?>

</body>