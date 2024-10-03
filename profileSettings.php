<?php
    session_start();
    require "settings/config.php";
    require_once "templates/header.php";

   
    include "classes/profileInfoClasses.php";
    include "classes/profileViewClasses.php";
    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;
    $profileInfo = new profileView($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/styles.css" rel="stylesheet">
    <title>Profile page</title>
</head>
<body>
    <?php renderNavBar($username, $loggedin)?>
    <section class="container">
        <h1>Hej <span style="color:blue"><?php echo $_SESSION["useruniqueId"]?></span></h1>
        <section class="profileSection">

            <div class="basicProfileInfo">
                <img class="profileImage" src="<?php echo $profileInfo->fetchImage($_SESSION["userId"])?>"/>
                <div class="nameAndEmail">
                    <p>Oskar</p>
                    <p>oskar@gmail.com</p>
                </div>
                <a href="profilesettings.php"><button class="cta">Rediger</button></a>
            </div>

            <h1>ProfilIndstillinger</h1>
        <section>
            <form action="includes/profileIncludes.php" method="post" enctype="multipart/form-data">
                <textarea name="about" id=""><?php $profileInfo->fetchAbout($_SESSION["userId"]);?></textarea>
                <textarea name="describtion" id=""><?php $profileInfo->fetchDescribtion($_SESSION["userId"]);?></textarea>
                <div>
                    <label class="labels" for="postImage">Post an image</label>
                    <input type="file" id="postImage" name="data[postImage]">
                </div>
                <button type="submit" name="submit">GEM</button>
            </form>
        </section>

        </section>
    </section>
</body>
</html>