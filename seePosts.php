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
    <title>Ripples</title>
</head>
<body>
    <?php renderNavBar($username, $loggedin)?>
    
    <section class="container">
        <h1>Your posts</h1>
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
                        <p class="postText"><?php echo $post->textContent?></p>

                        <?php if(!empty($post->postImage)): ?>
                            <div class="imgContainer">
                                <img class="postImg" src="data:image/jpeg;base64,<?php echo base64_encode($post->postImage); ?>" alt="<?php echo $post->textContent?> ">
                            </div>
                    </div>
                <?php endif; ?>
                <?php
            }
        ?>

    </section>
    <section class="container">
        <h2>All user posts</h2>
        <?php 
            $sqlCall = "SELECT * FROM posts";
            $posts = $db->sql($sqlCall);

            foreach($posts as $post){
                ?>
                <div class="post">
                        <p class="postText"><?php echo $post->textContent?></p>

                <?php if(!empty($post->postImage)): ?>
                    <div class="imgContainer">
                        <img class="postImg" src="data:image/jpeg;base64,<?php echo base64_encode($post->postImage); ?>" alt="<?php echo $post->textContent?> ">
                    </div>
                    <?php endif; ?>
                    
                </div>
                <?php
            }
        ?>
    </section>
</body>
</html>