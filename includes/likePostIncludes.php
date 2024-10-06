<?php

session_start();

if (isset($_POST["submit"])) {
    // Load the post ID and user ID
    $post_id = htmlspecialchars($_POST["post_id"], ENT_QUOTES, 'UTF-8');
    $user_id = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

    // Check if user is logged in
    if ($user_id === null) {
        header("Location: ../login.php");
        exit();
    }

    // Include necessary classes
    include "../classes/classDB.php";  // Your DB class
    include "../classes/likePostClass.php";  // The class that handles the like logic
    include "../classes/likePostControllerClass.php";  // The controller class

    // Instantiate the controller and call the method to like a post
    $likePost = new likePostController($user_id, $post_id);
    $likePost->likePost();

    // Redirect back to the post or another page after success
    header("Location: ../index.php");
    exit();
}

// session_start();
// include "../classes/classDB.php";
// require "../settings/config.php";

// $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
// $loggedin = isset($_SESSION['useruniqueId']) ? true : false;

// // Only run if the user is logged in
// if (isset($_SESSION["userId"]) && isset($_POST["post_id"])) {
//     $user_id = $_SESSION["userId"];
//     $post_id = $_POST["post_id"];

//     // Insert like into the database
//     $likeSql = "INSERT INTO likes (user_like_connection_id, post_like_connection_id) VALUES (:user_id, :post_id)";
//     $bind = [
//         ":user_id" => $user_id,
//         ":post_id" => $post_id
//     ];

//     $db->sql($likeSql, $bind, false);
//     header("Location: ../index.php");
//     exit; 
// }

?>