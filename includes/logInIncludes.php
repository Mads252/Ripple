<?php


if(isset($_POST["submit"])){


    // indlæsning af dataen
    $userId = $_POST["userId"];
    $password = $_POST["password"];
   



    //instansier signUp
    include "../classes/classDB.php";
    include "../classes/logInClasses.php";
    include "../classes/logInControllerClasses.php";

    $logIn = new logInController($userId, $password);

    // start 

    $logIn->logInUser();

    // tilbage til start

    header("location: ../index.php?error=none");
   
}