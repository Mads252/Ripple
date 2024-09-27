<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){


    // indlæsning af dataen
    $userId = htmlspecialchars($_POST["userId"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
    $passwordRepeat = htmlspecialchars($_POST["passwordRepeat"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    



    //instansier signUp
    include "../classes/classDB.php";
    include "../classes/signUpClasses.php";
    include "../classes/signUpControllerClasses.php";


    $signUp = new signUpController($userId, $password, $passwordRepeat, $email);

    // start 

    $signUp->signUpUser();

    $user_Id = $signUp->fetchUserId($userId);

    // indlæsning af profil
    include "../classes/profileInfoClasses.php";
    include "../classes/profileInfoControllerClasses.php";
    $profileInfo = new profileInfoController($user_Id, $userId);

    $profileInfo->preSetProfileInfo();
    // tilbage til start

    header("location: ../index.php?error=none");
   
}