<?php 
    require "settings/config.php";
    require_once "templates/header.php";

    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;
    $post_id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/styles.css" rel="stylesheet">
    <title>Edit Post</title>
</head>
<body>
    <?php renderNavBar($username, $loggedin) ?>

    <?php 
    $sql = "SELECT * FROM posts WHERE post_id = :post_id";
    $bind = [
        ":post_id"=>$post_id,
    ];
    $posts = $db->sql($sql, $bind);
    $post = $posts[0];

    ?>

    <form class="formContainer" action="index.php" method="post" enctype="multipart/form-data">
            <h2>Update post<?php echo $pos->post_id ?></h2>
            <div class="textContentContainer">
                <label class="labels" for="textContentInput">Subject</label>
                <textarea class="textArea" id="textContentInput" name="data[textContent]" rows="10">
                    <?php echo $post->textContent ?>
                </textarea>
            </div>
            
            <div>
                <label class="labels" for="postImage">Choose a new image</label>
                <input type="file" id="postImage" name="data[postImage]">
            </div>

            <button type="submit" class="submitBtn">Update post</button>
        </form> 
</body>
</html>