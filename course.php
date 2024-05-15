
<?php
session_start();
$_SESSION['loggedin'] = true;

if (isset($_SESSION['username']))
{
    echo $_SESSION['username'];
}

include'admin/connect.php';
include'includes/functions/functions.php';

$pic ='';





if ($pic != NULL || $pic != '')
{
    $_SESSION['profilePic'] = $pic;
}
else 
{
    $pic = "/assets/userImages/DefualtUser.png";
    $_SESSION['profilePic'] = $pic;
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../layout/css/main.css">
    <link rel="stylesheet" href="./layout/css/index.css">
    <link rel="stylesheet" href="./layout/css/courses.css">
    <link rel="stylesheet" href="./layout/assets/css/">


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

    
    <title>Home</title>
</head>
<body>
<?php include 'includes/template/navhome.php'?>

    <!--
    <div class="container-l">
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1616400619175-5beda3a17896?q=80&w=1674&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
        </div>
        <div class="hero-text">
            <div class="quotes">
            <h3>Learn</h3>
            <h2>grow</h2>
            <h1>prosper</h1>
            </div>
            
        </div>
    </div> -->

    <div class="courses">
        
            
            <!-- Playlist Items -->
            


        
    </div>

    <div>
    <div class="course-view" id="course-view Hidden" >
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
                       

                        <div class="course">
                            <div class="close"><button onclick="document.getElementById('course-view').classList.add('Hidden');"><i class="fas fa-times"></i></button></div>
                        <div class="statues">
                                    <div><i class=" fas fa-circle me-2 text-success"></i><span class="text-success"><?= $fetch_playlist['status']; ?></span></div>
                                    <div><i class="fas fa-calendar me-2"></i><span><?= $fetch_playlist['date']; ?></span></div>
                                </div>
                                <div class="thumb">
                                    <span class="badge bg-secondary"><?= $total_videos; ?> Videos</span>
                                    <img src="uploaded_files/<?= $fetch_playlist['image']; ?>" class="img-fluid">
                                </div>
                                <h3 class="title mt-3"><?= $fetch_playlist['title']; ?></h3>
                                <p class="description"><?= $fetch_playlist['description']; ?></p>
                                <!-- Delete Playlist Form -->
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-md-4"><div class="box"><p class="empty">No playlist added yet!</p></div></div>';
                }
                ?>
    </div>
    </div>
    
    <script src="./layout/js/index.js"></script>
</body>
</html>



