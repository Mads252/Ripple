<?php
    session_start();
    require "settings/config.php";
    require_once "templates/header.php";

    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;
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
        <h1>Hej <span style="color:blue">Oskar</span></h1>
        <section class="profileSection">

            <div class="basicProfileInfo">
                <img class="profileImage" src="./images/image1.png"/>
                <div class="nameAndEmail">
                    <p>Oskar</p>
                    <p>oskar@gmail.com</p>
                </div>
                <button class="cta">Rediger</button>
            </div>

            <div class="profileTextAndPosts">
                <div class="profileText">
                    <h3 class="textHeader">Profiltekst</h3>
                    <div class="underline"></div>
                    <p class="textAndPosts">Hei! Jeg heter Oskar 🇳🇴. Jeg er en eventyrlysten person som elsker naturen 🌲 og fjellturer 🏔️. 
                        På fritiden liker jeg å fiske 🎣, stå på ski ⛷️ og høre på god musikk 🎶. 
                        Jeg er også glad i teknologi 💻 og er alltid nysgjerrig på å lære nye ting! 🙌</p>
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