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
        <h1>Hej <span class="skyBlue"><?php echo $_SESSION["useruniqueId"]?></span></h1>
        <section class="profileSection">

            <div class="basicProfileInfo">
                <img class="profileImage" src="<?php echo $profileInfo->fetchImage($_SESSION["userId"])?>"/>
                <div class="nameAndEmail">
                    <p>Oskar</p>
                    <p>oskar@gmail.com</p>
                </div>
                <a href="profilesettings.php"><button class="CTA">Rediger</button></a>
            </div>

            <div class="profileTextAndPosts">
                <div class="profileText">
                    <h3 class="textHeader">Profiltekst</h3>
                    <div class="underline"></div>
                    <p class="textAndPosts"><?php $profileInfo->fetchAbout($_SESSION["userId"]);?></p>
                </div>
                <div class="profileText">
                    <h3 class="textHeader">Beskrivelse</h3>
                    <div class="underline"></div>
                    <p class="textAndPosts"><?php $profileInfo->fetchAbout($_SESSION["userId"]);?></p>
                </div>
                <div>
                    <h3 class="textHeader">Dine opslag</h3>
                    <div class="underline"></div>
                    <div class="textAndPosts postsSection">
                        <div class="postCard">
                            <img src="./images/image1.png" class="postImage"/>
                            <div class="cardText">
                                <p>Nyter livet i solen! #sol</p>
                                <div class="profileThumbnail">
                                    <img src="./images/kjekkMann.png" class="profileThumbnail">
                                    <p>Oskar</p>
                                </div>
                            </div>
                        </div>

                        <div class="postCard">
                            <img src="./images/image1.png" class="postImage"/>
                            <div class="cardText">
                                <p>Nyter livet i solen! #sol</p>
                                <div class="profileThumbnail">
                                    <img src="./images/kjekkMann.png" class="profileThumbnail">
                                    <p>Oskar</p>
                                </div>
                            </div>
                        </div>

                        <div class="postCard">
                            <img src="./images/image1.png" class="postImage"/>
                            <div class="cardText">
                                <p>Nyter livet i solen! #sol</p>
                                <div class="profileThumbnail">
                                    <img src="./images/kjekkMann.png" class="profileThumbnail">
                                    <p>Oskar</p>
                                </div>
                            </div>
                        </div>

                        <div class="postCard">
                            <img src="./images/image1.png" class="postImage"/>
                            <div class="cardText">
                                <p>Nyter livet i solen! #sol</p>
                                <div class="profileThumbnail">
                                    <img src="./images/kjekkMann.png" class="profileThumbnail">
                                    <p>Oskar</p>
                                </div>
                            </div>
                        </div>

                        <div class="postCard">
                            <img src="./images/image1.png" class="postImage"/>
                            <div class="cardText">
                                <p>Nyter livet i solen! #sol</p>
                                <div class="profileThumbnail">
                                    <img src="./images/kjekkMann.png" class="profileThumbnail">
                                    <p>Oskar</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </section>
</body>
</html>