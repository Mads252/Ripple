<?php
    session_start();
    require "settings/config.php";
    require_once "templates/header.php";

    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;

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
    <link href="./styles/styles.css" rel="stylesheet">
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
                            <a class="editBtn" href="./editPost.php?id=<?php echo $post->post_id ?>">Edit</a>
                            <form method="post" action="seePosts.php">
                                <input type="hidden" name="post_id" value="<?php echo $post->post_id ?>">
                                <button type="submit" class="deleteBtn">Delete</button>
                            </form>
                            <?php endif; ?>
                        </div>
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
                    <a href="likePost.php?id=<?php echo $post->post_id ?>">Like</a>
                    <form method="post" action="includes/likePost.php">
                        <button type="submit">Like this post</button>
                    </form>
                </div>
                <?php
            }
        ?>
    </section>
</body>
</html>