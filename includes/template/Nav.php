<ul class="navbar-nav  justify-content-end">
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