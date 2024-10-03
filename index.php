<?php
    session_start();
    require "settings/config.php";
    require_once "templates/header.php";
    require_once "templates/profileComponent.php";
    
    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;

    include "classes/profileInfoClasses.php";
    include "classes/profileViewClasses.php";
    $profileInfo = new profileView($db);
    $image_path = $profileInfo->fetchImage($_SESSION["userId"]);



    // if(!empty($_POST["data"])){
    //     $data = $_POST["data"];

    //     if(isset($_FILES['data']['tmp_name']['postImage']) && !empty($_FILES['data']['tmp_name']['postImage'])){
    //         $imageData = file_get_contents($_FILES['data']['tmp_name']['postImage']);
    //     } else {
    //         $imageData = null; // Handle case where no image was uploaded
    //     }

    //     if(isset($_SESSION["userId"])) {
    //         $user_id = $_SESSION["userId"];
    //     }


    //     $sql = "INSERT INTO posts (users_id, textContent, postImage) VALUES (:user_id, :textContent, :postImage)";
    //     $bind = [
    //         ":user_id" => $user_id,
    //         ":textContent" => $data["textContent"], 
    //         ":postImage" => $imageData
    //     ];

    //     $db->sql($sql, $bind, false);

    //     $post_id = $db->lastInsertId();
    //     $sql = "INSERT INTO user_posts (user_connection_id, post_connection_id) VALUES (:user_id, :post_id)";
    //     $bind = [
    //         ":user_id" => $user_id,
    //         ":post_id" => $post_id,
    //     ];

    //     $db->sql($sql, $bind, false);
    // }
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
            <?php profileComponent($username, $loggedin, $image_path)?>
        </section>

        <section class="container">
            <h1>Feed</h1>

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
                    <form method="post" action="includes/likePostIncludes.php">
                        <input type="hidden" name="post_id" value="<?php echo $post->post_id; ?>">
                        <button type="submit" name="submit">Like this post</button>
                    </form>
                </div>
                <?php
            }
        ?>
        </section>

        <!-- <form class="formContainer" action="index.php" method="post" enctype="multipart/form-data">
            <h2>Add post</h2>
            <div class="textContentContainer">
                <label class="labels" for="textContentInput">Subject</label>
                <textarea class="textArea" id="textContentInput" name="data[textContent]" placeholder="Write something.." rows="10"></textarea>
            </div>
            
            <div>
                <label class="labels" for="postImage">Post an image</label>
                <input type="file" id="postImage" name="data[postImage]">
            </div>

            <button type="submit" class="submitBtn">Add post</button>
        </form>  -->

</body>
</html>