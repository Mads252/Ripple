<?php 
    session_start();

    require_once "settings/config.php";

    function profileComponent($username, $loggedin, $image_path){
        ?>
        <div class="profileBanner">
            <h2 class="homeProfileText"><?php echo $username ?></h2>
            <img src="<?php echo $image_path ?>" alt="profileimage" class="profileBannerImage"/>
         </div>
    <?php 
    }
?>