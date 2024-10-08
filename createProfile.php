<?php
    session_start();
    require "settings/config.php";
    require_once "templates/header.php";
    require_once "templates/profileComponent.php";
    
    $username = isset($_SESSION['useruniqueId']) ? $_SESSION['useruniqueId'] : 'Guest';
    $loggedin = isset($_SESSION['useruniqueId']) ? true : false;

    if(!empty($_POST["data"])){
        $data = $_POST["data"];

        if(isset($_FILES['data']['tmp_name']['postImage']) && !empty($_FILES['data']['tmp_name']['postImage'])){
            $imageData = file_get_contents($_FILES['data']['tmp_name']['postImage']);
        } else {
            $imageData = null; // Handle case where no image was uploaded
        }

        if(isset($_SESSION["userId"])) {
            $user_id = $_SESSION["userId"];
        }


        $sql = "INSERT INTO posts (users_id, textContent, postImage) VALUES (:user_id, :textContent, :postImage)";
        $bind = [
            ":user_id" => $user_id,
            ":textContent" => $data["textContent"], 
            ":postImage" => $imageData
        ];

        $db->sql($sql, $bind, false);

        $post_id = $db->lastInsertId();
        $sql = "INSERT INTO user_posts (user_connection_id, post_connection_id) VALUES (:user_id, :post_id)";
        $bind = [
            ":user_id" => $user_id,
            ":post_id" => $post_id,
        ];

        $db->sql($sql, $bind, false);
    }
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/styles.css" rel="stylesheet">
    <title>Ripples</title>
</head>
<body>
        <?php renderNavBar($username, $loggedin)?>
        <section class="container">
            
        </section>

       
        <main class="mainClass"> 
        <section class="logIn-section">
        <div class="log-in-container">
        <div class="logo-login">
            <img src="images/IMG_2471.PNG" style="width: 70px;" alt="logo">
            <p class="logo-tekst">Velkommen</p>
        </div>
       <form action="includes/signUpIncludes.php" method="post" class="log-in-form">
        <div>
            <p class="inputP">Brugernavn</p>
            <input type="text" name="userId" class="input-login" placeholder="Ripple">
        </div>
        <div>
            <p class="inputP">Mail</p>
            <input class="input-login" type="text" name="email" placeholder="Ripple@mail.dk">
        </div>
        <div>
            <p class="inputP">Kodeord</p>
            <input type="password" name="password" class="input-login" placeholder="********">
        </div>
        <div>
            <p class="inputP">Gentag kodeord</p>
            <input type="password" name="passwordRepeat" class="input-login" placeholder="********">
        </div>
        
        <button class="CTA" type="submit" name="submit">Register</button>
        <div class="gray">
            <p class="gray">Or if you have a user, login </p><a href="login.php" class="here"> here</a>
        </div>
       </form>
    </div>


</section>
</main>
</body>
</html>