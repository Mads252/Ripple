<?php 
    session_start();
    require_once "settings/config.php";

    function renderNavBar($username, $loggedin){
        ?>
        <nav>
            <ul>
                
                <li><a href="index.php">Home</a></li>
                <li><a href="seePosts.php">Add posts</a></li>
                
                <?php 
                if ($loggedin){
                    ?>
                <li class="logout"><a href="includes/logOutIncludes.php">Logout</a></li>
                <li class="username"><a href="profile.php"><?php echo $username ?></a></li>
                <?php
                }
                ?>
                <li class="username"><a href="createProfile.php">Guest</a></li>
            </ul>
        </nav>   
        <?php 
    }
?>