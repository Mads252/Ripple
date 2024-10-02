<?php
class likePost extends db {

    protected function setLike($user_id, $post_id) {
        // Prepare the SQL statement to insert the like
        $stmt = $this->openPDO()->prepare('INSERT INTO likes (user_like_connection_id, post_like_connection_id) VALUES (?, ?)');
        
        // Execute the statement and check for errors
        if (!$stmt->execute([$user_id, $post_id])) {
            $stmt = null;
            header("Location: ../index.php?id=" . $post_id . "&error=stmtFailed");
            exit();
        }

        $stmt = null;  // Close the statement
    }

    // Optionally, check if the user has already liked the post (to prevent duplicate likes)
    protected function checkLike($user_id, $post_id) {
        $stmt = $this->openPDO()->prepare('SELECT * FROM likes WHERE user_like_connection_id = ? AND post_like_connection_id = ?');
        if (!$stmt->execute([$user_id, $post_id])) {
            $stmt = null;
            header("Location: ../index.php?id=" . $post_id . "&error=stmtFailed");
            exit();
        }

        return $stmt->rowCount() > 0;
    }
}