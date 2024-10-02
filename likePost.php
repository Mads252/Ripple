<?php
    session_start();
    require "settings/config.php";
    require_once "templates/header.php";

    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;

    $user_id = $_SESSION["userId"];
    $post_id = $_GET["id"];

    if(!empty($_POST["post_id"]) && isset($_SESSION["userId"])){
        
        $likeSql = "INSERT INTO likes (user_like_connection_id, post_like_connection_id) VALUES (:user_id, :post_id)";
        $bind = [
            ":user_id"=>$user_id,
            ":post_id"=>$post_id
        ];

        $db->sql($likeSql, $bind, false);

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/styles.css" rel="stylesheet">
    <title>Ripples - Like</title>
</head>
<body>
    <?php renderNavBar($username, $loggedin)?>
    
    <section class="container">
        <form action="likePost.php?id=<?php echo $post_id ?>" method="post">
            <p>User: <?php echo $user_id ?></p>
            <p>User: <?php echo $username ?></p>
            <p>Post: <?php echo $post_id ?></p>
            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
            <button type="submit">Like</button>
        </form>
    </section>
</body>
</html>