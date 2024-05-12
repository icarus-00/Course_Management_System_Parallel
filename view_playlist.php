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
if(isset($_POST['delete'])){

    $delete_id = $_POST['playlist_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    $verify_playlist = $con->prepare("SELECT * FROM `playlist` WHERE id = ? AND user_id = ? LIMIT 1");
    $verify_playlist->execute([$delete_id, $tutor_id]);
    if($verify_playlist->rowCount() > 0){
        $delete_playlist_thumb = $con->prepare("SELECT * FROM `playlist` WHERE id = ? LIMIT 1");
        $delete_playlist_thumb->execute([$delete_id]);
        $fetch_thumb = $delete_playlist_thumb->fetch(PDO::FETCH_ASSOC);
        unlink('./uploaded_files/'.$fetch_thumb['image']);
        $delete_playlist = $con->prepare("DELETE FROM `playlist` WHERE id = ?");
        $delete_playlist->execute([$delete_id]);
        $delete_content = $con->prepare("DELETE  FROM `content` WHERE playlist_id = ?");
        $delete_content->execute([$delete_id]);
        $message[] = 'playlist deleted!';
    }else{
        $message[] = 'playlist already deleted!';
    }
}
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
    header('location:view_playlist.php');

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
        /* Custom styles (if needed) */
        .playlist-details {
            padding: 50px 0;
        }

        .thumb {
            position: relative;
            width: 200px;
            height: 150px;
            overflow: hidden;
            border-radius: 8px;
        }

        .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .details {
            padding-left: 20px;
        }

        .title {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .date {
            margin-bottom: 10px;
            color: #6c757d;
        }

        .description {
            color: #343a40;
        }

        .flex-btn {
            display: flex;
            align-items: center;
        }

        .option-btn,
        .delete-btn {
            margin-right: 10px;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .option-btn {
            background-color: #007bff;
            color: #fff;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .empty {
            margin-top: 20px;
            font-style: italic;
            color: #6c757d;
        }
        .section-divider {
            border-top: 2px solid #2f2d2d;
            margin-top: 40px;
            margin-bottom: 40px;
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
    <section class="playlist-details">
        <h1 class="heading mb-4">Playlist Details</h1>

        <?php
        $select_playlist = $con->prepare("SELECT * FROM `playlist` WHERE id = ? AND user_id = ?");
        $select_playlist->execute([$get_id, $tutor_id]);
        if($select_playlist->rowCount() > 0){
            while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
                $playlist_id = $fetch_playlist['id'];
//                $count_videos = $con->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
//                $count_videos->execute([$playlist_id]);
//                $total_videos = $count_videos->rowCount();
                ?>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="thumb">
                            <span class="badge bg-secondary"> Videos</span>
                            <img src="uploaded_files/<?= $fetch_playlist['image'];?>">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="details">
                            <h3 class="title"><?= $fetch_playlist['title']; ?></h3>
                            <div class="date"><i class="fas fa-calendar me-2"></i><?= $fetch_playlist['date']; ?></div>
                            <div class="description"><?= $fetch_playlist['description']; ?></div>
                            <form action="" method="post" class="flex-btn mt-3">
                                <input type="hidden" name="playlist_id" value="<?= $playlist_id; ?>">
                                <a href="update_playlist.php?get_id=<?= $playlist_id; ?>" class="btn option-btn">Update Playlist</a>
                                <input type="submit" value="Delete Playlist" class="btn delete-btn" onclick="return confirm('Delete this playlist?');" name="delete">
                                <a href="add_content.php?get_id=<?= $playlist_id; ?>" class="btn option-btn" style="margin-top: 1.5rem;">add videos</a>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">No playlist found!</p>';
        }
        ?>
        <hr class="section-divider">
    </section>
    <section class="contents">

        <h1 class="heading">playlist videos</h1>

        <div class="box-container">

            <?php
            $select_videos = $con->prepare("SELECT * FROM `content` WHERE user_id = ? AND playlist_id = ?");
            $select_videos->execute([$tutor_id, $playlist_id]);
            if($select_videos->rowCount() > 0){
                while($fecth_videos = $select_videos->fetch(PDO::FETCH_ASSOC)){
                    $video_id = $fecth_videos['id'];
                    ?>
                    <div class="box">
                        <div class="flex">
                            <div><i class="fas fa-dot-circle" style="<?php if($fecth_videos['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fecth_videos['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fecth_videos['status']; ?></span></div>
                            <div><i class="fas fa-calendar"></i><span><?= $fecth_videos['date']; ?></span></div>
                        </div>
                        <img src="uploaded_files/<?= $fecth_videos['image']; ?>" class="thumb" alt="">
                        <h3 class="title"><?= $fecth_videos['title']; ?></h3>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="flex-btn">
                            <input type="hidden" name="video_id" value="<?= $video_id; ?>">
                            <a href="update_content.php?get_id=<?= $video_id; ?>" class="option-btn">update</a>
                            <input type="submit" value="delete_video" class="delete-btn" onclick="return confirm('delete this video?');" name="delete_video">
                        </form>
                        <a href="view_content.php?get_id=<?= $video_id; ?>" class="btn">watch video</a>
                    </div>
                    <?php
                }
            }else{
                echo '<div class="container mt-5">';
                echo '<p class="empty">No videos added yet!</p>';
                echo '</div>';}
            ?>

        </div>

    </section>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <?php include "includes/template/footer.php";?>

</body>