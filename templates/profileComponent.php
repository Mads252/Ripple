<?php 
    session_start();

    require_once "settings/config.php";

    function profileComponent($username, $loggedin){
        ?>
        <div class="profileBanner">
            <h2 class="homeProfileText"><?php echo $username ?></h2>
            <img src="./images/image1.png" class="profileBannerImage"/>
         </div>
    <?php 
    }
?>