<?php 
    session_start();
    require_once "settings/config.php";

    function renderNavBar($username, $loggedin){
        ?>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="/ripple/seePosts.php">Posts</a></li>
                
                <?php 
                if ($loggedin){
                    ?>
                <li class="logout"><a href="includes/logOutIncludes.php">Logout</a></li>
                <?php
                }
                ?>
                <li class="username"><a><?php echo $username ?></a></li>
            </ul>
        </nav>   
        <?php 
    }
?>