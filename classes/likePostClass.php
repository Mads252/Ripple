<?php
class likePost extends db {

    protected function setLike($user_id, $post_id) {
        // gjør klart statementet
        $stmt = $this->openPDO()->prepare('INSERT INTO likes (user_like_connection_id, post_like_connection_id) VALUES (?, ?)');
        
        if (!$stmt->execute([$user_id, $post_id])) {
            $stmt = null;
            header("Location: ../index.php?id=" . $post_id . "&error=stmtFailed");
            exit();
        }

        $stmt = null;
    }

    protected function unlike($user_id, $post_id){
        $stmt = $this->openPDO()->prepare('DELETE FROM likes WHERE user_like_connection_id = ? AND post_like_connection_id = ?');

        if (!$stmt->execute([$user_id, $post_id])) {
            $stmt = null;
            header("Location: ../index.php?id=" . $post_id . "&error=stmtFailed");
            exit();
        }

        $stmt = null;
    }

    // funksjon som sjekker om det allerede fins et like i databasen
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