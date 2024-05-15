<nav class="nav-l">
        <div class="pages-logo">
        <a href="index.php" class="logo">CMS</a>
        <ul class="pages">
            <li><a href="home.php">Home</a></li>
            <li><a href="course.php">Courses</a></li>
            <li><a href="#">Testimony</a></li>
            <li><a href="#">About Us</a></li>
        </ul>
        </div>
        <ul class="buttons-l <?php if( isset($_SESSION['user']) ) echo "Hidden"; ?>">
            <li><a href="login.php">Login</a></li>
            <li><a  href="Sign-up.php">join</a></li>
        </ul>
        
        <?php
        if (isset($_SESSION['user']))
        {
        echo '
        <ul class="profile  ' . (isset($_SESSION['username']) && $_SESSION['username'] != '' ? '' : 'hidden') . ' ">
            <li><p>' . $_SESSION['username']. '</p> 
            <p> online</p>
            </li>
            <li><a class="avatar" href="profile.php"><img src=" ' .$_SESSION['profilePic'] . '" alt=""></a></li> </ul> ';
        }
        ?>
        
    </nav>