<?php 
    require "settings/config.php";
    require_once "templates/header.php";

    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;
    $post_id = $_GET["id"];

    if(isset($post_id) && isset($_SESSION["userId"])){
        $user_id = $_SESSION["userId"];

        $checkOwnerShipSql = "SELECT * FROM user_posts WHERE post_connection_id = :post_id AND user_connection_id = :user_id";
        $bind = [
            ":post_id"=>$post_id,
            ":user_id"=>$user_id,
        ];
        $result = $db->sql($checkOwnerShipSql, $bind);

        if(!empty($result)){

            if(!empty($_POST["data"])){
                $data = $_POST["data"];

            if(isset($_FILES["data"]["tmp_name"]["postImage"]) && !empty($_FILES["data"]["tmp_name"]["postImage"])){
                $imageData = file_get_contents($_FILES["data"]["tmp_name"]["postImage"]);
            } else {
                $imageData = null;
            }

            if(isset($_SESSION["userId"])) {
                $user_id = $_SESSION["userId"];
            }

            $sql = "UPDATE posts SET textContent = :textContent, postImage = :postImage WHERE post_id =:post_id";
            $bind = [
                "post_id"=>$post_id,
                "textContent"=>$data["textContent"],
                "postImage"=>$imageData,
            ];
            $db->sql($sql, $bind);
            }
        }
    }

    // if(!empty($_POST["data"])){
    //     $data = $_POST["data"];

    //     if(isset($_FILES["data"]["tmp_name"]["postImage"]) && !empty($_FILES["data"]["tmp_name"]["postImage"])){
    //         $imageData = file_get_contents($_FILES["data"]["tmp_name"]["postImage"]);
    //     } else {
    //         $imageData = null;
    //     }

    //     if(isset($_SESSION["userId"])) {
    //         $user_id = $_SESSION["userId"];
    //     }

    //     $sql = "UPDATE posts SET textContent = :textContent, postImage = :postImage WHERE post_id =:post_id";
    //     $bind = [
    //         "post_id"=>$post_id,
    //         "textContent"=>$data["textContent"],
    //         "postImage"=>$imageData,
    //     ];
    //     $db->sql($sql, $bind);
    // }
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

    <form class="formContainer" action="editPost.php?id=<?php echo $post_id ?>" method="post" enctype="multipart/form-data">
            <h2>Update post<?php echo $post->post_id ?></h2>
            <div class="textContentContainer">
                <label class="labels" for="textContentInput">Subject</label>
                <textarea class="textArea" id="textContentInput" name="data[textContent]" rows="10"><?php echo $post->textContent ?></textarea>
            </div>
            
            <div>
                <p>Your image:</p>
                <img class="postImg" src="data:image/jpeg;base64,<?php echo base64_encode($post->postImage); ?>">
                <label class="labels" for="postImage">Choose a new image</label>
                <input type="file" id="postImage" name="data[postImage]">
            </div>

            <button type="submit" class="submitBtn">Update post</button>
        </form> 
</body>
</html>