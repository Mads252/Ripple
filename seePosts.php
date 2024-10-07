<?php
    session_start();
    require "settings/config.php";
    require_once "classes/PostController.php";
    require_once "templates/header.php";
    include "classes/profileInfoClasses.php";
    include "classes/profileViewClasses.php";

    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;
    $user_id = isset($_SESSION["userId"]) ? $_SESSION["userId"] : null;
    
   
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
    
    <?php require "templates/addPostView.php"; ?>
</body>
</html>