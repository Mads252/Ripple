<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $userId = $_SESSION["userId"];
    $useruniqueId = $_SESSION["useruniqueId"];
    $about = htmlspecialchars($_POST["about"], ENT_QUOTES, 'UTF-8');
    $describtion = htmlspecialchars($_POST["describtion"], ENT_QUOTES, 'UTF-8');


    include_once "../classes/classDB.php";
    include "../classes/profileInfoClasses.php";
    include "../classes/profileInfoControllerClasses.php";


$profileInfo = new profileInfoController($userId, $useruniqueId);

$profileInfo->updateProfileInfo($about, $describtion);

header("location: ../profile.php?opdateret");

}