<?php


if(isset($_POST["submit"])){


    // indlæsning af dataen
    $userId = htmlspecialchars($_POST["userId"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
    



    //instansier signUp
    include "../classes/classDB.php";
    include "../classes/logInClasses.php";
    include "../classes/logInControllerClasses.php";

    $logIn = new logInController($userId, $password);

    // start 

    $logIn->logInUser();

    // tilbage til start

    header("location: ../profile.php?error=none");
   
}