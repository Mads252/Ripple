<?php
    session_start();
    require "settings/config.php";
    require_once "templates/header.php";
    
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/styles.css" rel="stylesheet">
    <title>Ripples</title>
</head>
<body>
        <?php renderNavBar($username, $loggedin)?>

        <form class="formContainer" action="index.php" method="post" enctype="multipart/form-data">
            <h2>Add post</h2>
            <div class="textContentContainer">
                <label class="labels" for="textContentInput">Subject</label>
                <textarea class="textArea" id="textContentInput" name="data[textContent]" placeholder="Write something.." rows="10"></textarea>
            </div>
            
            <div>
                <label class="labels" for="postImage">Post an image</label>
                <input type="file" id="postImage" name="data[postImage]">
            </div>

            <button type="submit" class="submitBtn">Add post</button>
        </form> 

    <section>
		<div class="sign-up">
            <form class="formContainer" action="includes/signUpIncludes.php" method="post">
                <h2>Lav en bruger</h2>
                <div>
                    <label class="labels" for="userId">Navn</label>
                    <input type="text" name="userId" placeholder="Navn">
                </div>
                <div>
                    <label class="labels" for="password">Password</label>
                    <input type="password" name="password" placeholder="Kodeord">
                </div>
                <div>
                    <label class="labels" for="passwordRepeat">Repeat password</label>
                    <input type="password" name="passwordRepeat" placeholder="Gentag Kodeord">
                </div>
                <div>
                    <label class="labels" for="email">Email</label>
                    <input type="text" name="email" placeholder="Email@">
                </div>
				<br>
				<button class="submitBtn" type="submit" name="submit">Lav din bruger</button>
			</form>
		</div>

		<div class="log-in">
            <form class="formContainer" action="includes/logInIncludes.php"  method="post">
                <h2>Log in</h2>
				<input type="text" name="userId" placeholder="Navn">
				<input type="password" name="password" placeholder="Kodeord">
				<br>
				<button class="submitBtn" type="submit" name="submit">Log in</button>
			</form>
		</div>

		
	</section>
</body>
</html>