
<div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" style="justify-content: flex-end;" id="navbar"></div>
<ul class="navbar-nav  " style="justify-content: start;">
                    <li class="nav-item d-flex align-items-center">
                                <a href="profile.php" class="nav-link text-body font-weight-bold px-0">
                                    <img class="avatar avatar-sm me-3" src="<?php echo $_SESSION['profilePic']; ?>" alt="">
                                    <span class="d-sm-inline d-none">
                                        <?php
                                        
                                        if ( isset($_SESSION['username']) || $_SESSION['username'] != '') {echo $_SESSION['username'] ;}
                                        else {
                                        header('Location: index.php');
                                        
                                        }
                                        
                                        ?>
                                        
                            </span>
                        </a>
                    </li>
                </ul>