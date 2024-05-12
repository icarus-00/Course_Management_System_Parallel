<?php
ob_start();
session_start();
if(isset($_SESSION['user'])){
    $tutor_id =$_SESSION['user'];
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

if(isset($_POST['submit'])) {

    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);
    $playlist = $get_id;
    $playlist = filter_var($playlist, FILTER_SANITIZE_STRING);
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = uniqid() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/' . $rename;
    $video = $_FILES['video']['name'];
    $video = filter_var($video, FILTER_SANITIZE_STRING);
    $video_ext = pathinfo($video, PATHINFO_EXTENSION);
    $rename_video = uniqid().'.'.$video_ext;
    $video_tmp_name = $_FILES['video']['tmp_name'];
    $video_folder = 'uploaded_files/'.$rename_video;
    if ($image_size > 2000000) {
        $message[] = 'image size is too large!';
    } else {
        $add_content = $con->prepare("INSERT INTO `content`(user_id, title, description, image, status,video,playlist_id) VALUES(?,?,?,?,?,?,?)");
        $add_content->execute([$tutor_id, $title, $description, $rename, $status, $rename_video, $playlist]);
        move_uploaded_file($image_tmp_name, $image_folder);
        move_uploaded_file($video_tmp_name, $video_folder);
        $message[] = 'new video created!';

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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Videos</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Add Video</h6>
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
            <h2 class="text-center mb-4">Add New Video</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Playlist Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">video Status <span>*</span></label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="" selected disabled>-- Select Status --</option>
                        <option value="active">Active</option>
                        <option value="deactive">Deactive</option>
                    </select>
                </div>

                <!-- Playlist Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Video Title <span>*</span></label>
                    <input type="text" name="title" id="title" class="form-control" maxlength="100" required placeholder="Enter Video Title">
                </div>

                <!-- Playlist Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Video Description <span>*</span></label>
                    <textarea name="description" id="description" class="form-control" required placeholder="Write Description" maxlength="1000" rows="5"></textarea>
                </div>

                <!-- Playlist Thumbnail -->
                <div class="mb-3">
                    <label for="image" class="form-label">video image <span>*</span></label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-control" required>
                </div>
                <!-- video link -->
                <div class="mb-3">
                    <label for="video" class="form-label">video  <span>*</span></label>
                    <input type="file" name="video" id="video" accept="video/*" class="form-control" required>
                </div>
                <!-- Submit Button -->
                <div class="mb-3">
                    <input type="submit" value="Add Video" name="submit" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>


    <?php include "includes/template/footer.php";?>
</body>
