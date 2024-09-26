<?php


if(isset($_POST["submit"])){


    // indlæsning af dataen
    $userId = $_POST["userId"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordRepeat"];
    $email = $_POST["email"];



    //instansier signUp
    include "../classes/classDB.php";
    include "../classes/signUpClasses.php";
    include "../classes/signUpControllerClasses.php";

    $signUp = new signUpController($userId, $password, $passwordRepeat, $email);

    // start 

    $signUp->signUpUser();

    // tilbage til start

    header("location: ../index.php?error=none");
   
}