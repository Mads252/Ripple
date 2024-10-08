<?php
require_once "classes/post.php";

class PostController {
    private $postModel;

    public function __construct($db) {
        $this->postModel = new Post($db);
    }

    public function handleAddPost($data, $file, $user_id) {
        $textContent = $data['textContent'] ?? '';
        $imageData = isset($file['tmp_name']['postImage']) && !empty($file['tmp_name']['postImage']) 
            ? file_get_contents($file['tmp_name']['postImage']) 
            : null;

        $post_id = $this->postModel->addPost($user_id, $textContent, $imageData);
        $this->postModel->linkUserToPost($user_id, $post_id);
    }
}
