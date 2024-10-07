<?php
class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addPost($user_id, $textContent, $imageData) {
        $sql = "INSERT INTO posts (users_id, textContent, postImage) VALUES (:user_id, :textContent, :postImage)";
        $bind = [
            ":user_id" => $user_id,
            ":textContent" => $textContent,
            ":postImage" => $imageData
        ];
        $this->db->sql($sql, $bind, false);

        return $this->db->lastInsertId();
    }

    public function linkUserToPost($user_id, $post_id) {
        $sql = "INSERT INTO user_posts (user_connection_id, post_connection_id) VALUES (:user_id, :post_id)";
        $bind = [
            ":user_id" => $user_id,
            ":post_id" => $post_id
        ];
        $this->db->sql($sql, $bind, false);
    }
}

//tjek