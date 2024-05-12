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
if(isset($_POST['delete_video'])){

    $delete_id = $_POST['video_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

    $delete_video_thumb = $con->prepare("SELECT image FROM `content` WHERE id = ? LIMIT 1");
    $delete_video_thumb->execute([$delete_id]);
    $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
    unlink('uploaded_files/'.$fetch_thumb['image']);

    $delete_video = $con->prepare("SELECT video FROM `content` WHERE id = ? LIMIT 1");
    $delete_video->execute([$delete_id]);
    $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
    unlink('uploaded_files/'.$fetch_video['video']);

//    $delete_likes = $con->prepare("DELETE FROM `likes` WHERE content_id = ?");
//    $delete_likes->execute([$delete_id]);
//    $delete_comments = $con->prepare("DELETE FROM `comments` WHERE content_id = ?");
//    $delete_comments->execute([$delete_id]);

    $delete_content = $con->prepare("DELETE FROM `content` WHERE id = ?");
    $delete_content->execute([$delete_id]);
    header('location:contents.php');

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
    < <style>
        body {
            background-color: #f8f9fe;
        }
        .video-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-top: 56.25%; /* 16:9 aspect ratio (responsive video) */
            margin-bottom: 20px;
            overflow: hidden;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .video-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .description {
            color: #6c757d;
            margin-bottom: 20px;
        }
        .interaction {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .interaction .btn {
            padding: 8px 16px;
            border-radius: 8px;
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
    <main class="container">
        <section class="view-content">
            <?php
            $select_content = $con->prepare("SELECT * FROM `content` WHERE id = ? AND user_id = ?");
            $select_content->execute([$get_id, $tutor_id]);

            if($select_content->rowCount() > 0){
                while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){
                    $video = $fetch_content['video'];
                    $video_title = $fetch_content['title'];
                    $video_description = $fetch_content['description'];
                    $video_date = $fetch_content['date'];
                    $video_id = $fetch_content['id'];
                    ?>
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-body">
                                <video src="uploaded_files/<?= $fetch_content['video']; ?>" autoplay controls poster="uploaded_files/<?= $fetch_content['هةشلث']; ?>" class="video"></video>
                                <div class="date mt-3"><i class="fas fa-calendar"></i> <?= $fetch_content['date']; ?></div>
                                <h3 class="title mt-3"><?= $fetch_content['title']; ?></h3>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div><i class="fas fa-heart"></i> <span><?= 5 ?></span></div>
                                    <div><i class="fas fa-comment"></i> <span><?= 6 ?></span></div>
                                </div>
                                <div class="description mt-3"><?= $fetch_content['description']; ?></div>
                                <form action="" method="post" class="mt-3">
                                    <input type="hidden" name="video_id" value="<?= $video_id; ?>">
                                    <a href="update_content.php?get_id=<?= $video_id; ?>" class="btn btn-primary me-2">Update</a>
                                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Delete this video?');" name="delete_video">
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo '<p class="empty">No content found!</p>';
            }
            ?>
        </section>
    </main>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <?php include "includes/template/footer.php";?>

</body>