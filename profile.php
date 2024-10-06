<?php


    session_start();
    require "settings/config.php";
    require_once "templates/header.php";

   
    include "classes/profileInfoClasses.php";
    include "classes/profileViewClasses.php";
    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;
    $email = isset($_SESSION['userEmail']);
    $profileInfo = new profileView($db);

    
    if(!empty($_POST["post_id"]) && isset($_SESSION["userId"])){
        
        $post_id = $_POST["post_id"];
        $user_id = $_SESSION["userId"];

        $checkOwnerShipSql = "SELECT * FROM user_posts WHERE post_connection_id = :post_id AND user_connection_id = :user_id";
        $bind = [
            "post_id"=>$post_id,
            ":user_id"=>$user_id,
        ];

        $result = $db->sql($checkOwnerShipSql, $bind);

        if(!empty($result)){
            $deleteUserPost = "DELETE FROM user_posts WHERE post_connection_id = :post_id AND user_connection_id = :user_id";
            $db->sql($deleteUserPost, $bind);
        }
    }
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
                    <p><?php echo $username ?></p>
                    <p><?php echo $_SESSION['userEmail']?></p>
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
                       <!-- <div class="postCard">
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
-->

                        <?php
            if(isset($_SESSION["userId"])) {
                $user_id = $_SESSION["userId"];
            }
            
            $sqlCall = "SELECT * FROM user_posts INNER JOIN posts ON post_connection_id = post_id WHERE user_connection_id = :user_id";
            $bind = [
                ":user_id"=>$user_id,
            ];
            $posts = $db->sql($sqlCall, $bind);
            
            foreach($posts as $post){
                ?>
                    <div class="post">
                        

                        <?php if(!empty($post->postImage)): ?>
                            <div class="postCard">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($post->postImage); ?>"  class="postImage" />
                            <div class="cardText">
                                <p><?php echo $post->textContent?></p>
                                <div class="profileThumbnail">
                                    <img src="<?php echo $profileInfo->fetchImage($_SESSION["userId"])?>" class="profileThumbnail">
                                    <p><?php echo $username ?></p>
                                    <a class="editBtn" href="./editPost.php?id=<?php echo $post->post_id ?>"><img src="images/editIcon.png" alt="rediger opslag" class="icons"></a>
                                    <form method="post" action="seePosts.php">
                                <input type="hidden" name="post_id" value="<?php echo $post->post_id ?>">
                                <button type="submit" class="deleteBtn"><img src="images/deleteIcon.png" alt="delete post" class="icons"></button>
                            </form>
                                </div>
                            </div>
                        </div>
                            <?php endif; ?>
                            
                            
                        </div>
                <?php
            }
        ?>

                    </div>
                </div>
            </div>

        </section>
           
    </section>
</body>
</html>