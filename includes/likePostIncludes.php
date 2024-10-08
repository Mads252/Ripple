<?php

session_start();

if (isset($_POST["submit"])) {
    // sjekker etter post id og user id
    $post_id = htmlspecialchars($_POST["post_id"], ENT_QUOTES, 'UTF-8');
    $user_id = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

    // hvis user id'en er null så blir man sendt til login siden
    if ($user_id === null) {
        header("Location: ../logIn.php");
        exit();
    }

    // Inkluderer de nødvendige classes
    include "../classes/classDB.php";
    include "../classes/likePostClass.php";
    include "../classes/likePostControllerClass.php";

    // henter likepostcontroller sånn at man kan bruke likepost funksjonen
    $likePost = new likePostController($user_id, $post_id);
    $likePost->likePost();

    // sender til index når posten er liket
    header("Location: ../index.php");
    exit();
}

?>