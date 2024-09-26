<?php
    session_start();
    require "settings/config.php";

    if(!empty($_POST["data"])){
        $data = $_POST["data"];

        if(isset($_FILES['data']['tmp_name']['postImage']) && !empty($_FILES['data']['tmp_name']['postImage'])){
            $imageData = file_get_contents($_FILES['data']['tmp_name']['postImage']);
        } else {
            $imageData = null; // Handle case where no image was uploaded
        }


        $sql = "INSERT INTO posts (textContent, postImage) VALUES (:textContent, :postImage)";
        $bind = 
            [":textContent" => $data["textContent"], 
            ":postImage" => $imageData
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
        <?php include("templates/header.php")?>

        <form class="addPostsForm" action="index.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="textContent">Text Content</label><br>
                <input class="textContentInput" type="text" id="textContent" name="data[textContent]" placeholder="Write what you want to say?"><br>
            </div>
            <div>
                <label for="postImage">Post an image</label><br>
                <input type="file" id="postImage" name="data[postImage]">
            </div>
            <button type="submit" class="submitBtn">Add post</button>
        </form> 

        <section>
		<div class="sign-up">
			<h2>Lav en bruger</h2>
			<form action="includes/signUpIncludes.php" method="post">
				<input type="text" name="userId" placeholder="Navn">
				<input type="password" name="password" placeholder="Kodeord">
				<input type="password" name="passwordRepeat" placeholder="Gentag Kodeord">
				<input type="text" name="email" placeholder="Email@">
				<br>
				<button type="submit" name="submit">Lav din bruger</button>
			</form>
		</div>
		<div class="log-in">
			<h2>Log in</h2>
			<form action="includes/logInIncludes.php"  method="post">
				<input type="text" name="userId" placeholder="Navn">
				<input type="password" name="password" placeholder="Kodeord">
				<br>
				<button type="submit" name="submit">Log in</button>
			</form>
		</div>

		<div class="logget-in">
			<?php
			if(isset($_SESSION["userId"]))

			{
				?>

				
				<h2><?php echo $_SESSION["useruniqueId"];?></h2>
				
				
				<a href="includes/logOutIncludes.php">log ud</a>
				
				<?php
			}
			else{
				?>
				<h2>log in</h2>
				
				
				<?php
			}
			?>
		</div>
	</section>
</body>
</html>