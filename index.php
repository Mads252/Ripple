<?php
session_start();
require "settings/config.php";
require_once "classes/PostController.php";
require_once "templates/header.php";
require_once "templates/profileComponent.php";

$username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
$loggedin = isset($_SESSION['useruniqueId']) ? true : false;

$user_id = isset($_SESSION["userId"]) ? $_SESSION["userId"] : null;


include "classes/profileInfoClasses.php";
include "classes/profileViewClasses.php";
$profileInfo = new profileView($db);
$image_path = $profileInfo->fetchImage($_SESSION["userId"]);
// Instansier controlleren
$postController = new PostController($db);

// Håndter form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'addPost') {
    $data = $_POST["data"] ?? [];
    $file = $_FILES['data'] ?? [];
    
    if ($user_id) {
        $postController->handleAddPost($data, $file, $user_id);
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

<div class="homePage">

    <section class="container">
        <?php profileComponent($username, $loggedin, $image_path)?>
    </section>

    <section class="container">
        <h1>Feed</h1>
        <div class="underline"></div>
        <div class="postContainer">
        <?php 
        $sqlCall = "SELECT * FROM posts";
        $posts = $db->sql($sqlCall);

        foreach($posts as $post){
            ?>
                <div class="post">

                    <?php if(!empty($post->postImage)): ?>
                    <div class="postCard">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($post->postImage); ?>"  class="postImage" />
                        <div class="cardText">
                            <p><?php echo $post->textContent?></p>
                            <div class="profileThumbnail">
                                <div class="profileThumbnailContainer">
                                    <img src="<?php echo $profileInfo->fetchImage($_SESSION["userId"])?>" class="profileImage">
                                </div>
                                <p><?php echo $username ?></p>
                                <form method="post" action="includes/likePostIncludes.php">
                                    <input type="hidden" name="post_id" value="<?php echo $post->post_id; ?>">
                                    <button type="submit" name="submit"><img src="images/hand-thumbs-up-fill.svg"></button>
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
    </section>

</div>

    <!-- Add Post Form -->
    <?php require "templates/addPostView.php"; ?>
</body>
</html>
