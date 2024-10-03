<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $userId = $_SESSION["userId"];
    $useruniqueId = $_SESSION["useruniqueId"];
    $about = htmlspecialchars($_POST["about"], ENT_QUOTES, 'UTF-8');
    $describtion = htmlspecialchars($_POST["describtion"], ENT_QUOTES, 'UTF-8');

    if(isset($_FILES['data']['tmp_name']['postImage']) && !empty($_FILES['data']['tmp_name']['postImage'])){
        $profile_image = file_get_contents($_FILES['data']['tmp_name']['postImage']);
    } else {
        $profile_image = null; // Handle case where no image was uploaded
    }


    include_once "../classes/classDB.php";
    include "../classes/profileInfoClasses.php";
    include "../classes/profileInfoControllerClasses.php";


$profileInfo = new profileInfoController($userId, $useruniqueId);

$profileInfo->updateProfileInfo($about, $describtion, $profile_image);

header("location: ../profile.php?opdateret");

}