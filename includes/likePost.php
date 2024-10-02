<?php
session_start();
include "../classes/classDB.php";
// require "../settings/config.php";

$username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
$loggedin = isset($_SESSION['useruniqueId']) ? true : false;

$user_id = $_SESSION["userId"];
$post_id = $_GET["id"];

// Only run if the user is logged in
if (isset($_SESSION["userId"]) && isset($_POST["post_id"])) {
    $user_id = $_SESSION["userId"];
    $post_id = $_POST["post_id"];

    // Insert like into the database
    $likeSql = "INSERT INTO likes (user_like_connection_id, post_like_connection_id) VALUES (:user_id, :post_id)";
    $bind = [
        ":user_id" => $user_id,
        ":post_id" => $post_id
    ];

    $db->sql($likeSql, $bind, false);
    header("Location: ../index.php");
    exit; 

}
?>