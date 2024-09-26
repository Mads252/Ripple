<?php
    require "settings/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/styles.css" rel="stylesheet">
    <title>Ripples</title>
</head>
<body>
    <?php include("templates/header.php")?>
        <?php
        $sqlCall = "SELECT * FROM posts";
        $posts = $db->sql($sqlCall);
        
        foreach($posts as $post){
            ?>
            <div class="row">
                <div class="col-12 col-md-6">
                    <a href="index.php" class="btn btn-primary"><?php echo $post->textContent?></a>

                    <?php if(!empty($post->postImage)): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($post->postImage); ?>" alt="<?php echo $post->textContent?> ">
                </div>
            </div>
            <?php endif; ?>
            <?php
        }
        ?>
</body>
</html>