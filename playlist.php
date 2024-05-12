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
        .box {
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
        }

        .thumb img {
            max-width: 100%;
            height: auto;
        }

        .description {
            color: #6c757d; /* Bootstrap text-muted color */
        }

        .btn-view {
            background-color: #007bff;
            color: #fff;
        }
        option-btn,
        .delete-btn,
        .btn-watch {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .option-btn {
            background-color: #007bff;
            color: #fff;
            margin-right: 10px;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-watch {
            background-color: #28a745;
            color: #fff;
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
    <header class="bg-dark py-3 text-white">
        <div class="container">
            <h1 class="display-4">Added Playlists</h1>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row">

                <!-- Create New Playlist Box -->
                <div class="col-md-4">
                    <div class="box text-center">
                        <h3 class="title mb-3">Create New Playlist</h3>
                        <a href="add_playlist.php" class="btn btn-primary">Add Playlist</a>
                    </div>
                </div>

                <!-- Playlist Items -->
                <?php
                $select_playlist = $con->prepare("SELECT * FROM `playlist` WHERE user_id = ?");
                $select_playlist->execute([$tutor_id]);
                if($select_playlist->rowCount() > 0){
                    while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
                        $playlist_id = $fetch_playlist['id'];
                        $count_videos = $con->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
                        $count_videos->execute([$playlist_id]);
                        $total_videos = $count_videos->rowCount();
                        ?>
                        <div class="col-md-4">
                            <div class="box">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div><i class="fas fa-circle me-2 text-success"></i><span class="text-success"><?= $fetch_playlist['status']; ?></span></div>
                                    <div><i class="fas fa-calendar me-2"></i><span><?= $fetch_playlist['date']; ?></span></div>
                                </div>
                                <div class="thumb">
                                    <span class="badge bg-secondary"><?= $total_videos; ?> Videos</span>
                                    <img src="uploaded_files/<?= $fetch_playlist['image']; ?>" class="img-fluid">
                                </div>
                                <h3 class="title mt-3"><?= $fetch_playlist['title']; ?></h3>
                                <p class="description"><?= $fetch_playlist['description']; ?></p>
                                <!-- Delete Playlist Form -->
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="button-container">
                                    <a href="update_playlist.php?get_id=<?= $playlist_id; ?>" class="btn option-btn">Update</a>
                                    <input type="hidden" name="playlist_id" value="<?= $playlist_id; ?>">
                                    <div class="button-container">
                                        <button type="submit" class="btn delete-btn" onclick="return confirm('Delete this playlist?');" name="delete">Delete</button>
                                    </div>
                                </div>
                                <div class="button-container">
                                    <a href="view_playlist.php?get_id=<?= $playlist_id; ?>" class="btn btn-watch">Watch Playlist</a>
                                </div>
                                </form>
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
    </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <?php include "includes/template/footer.php";?>

</body>