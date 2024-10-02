<?php
class likePostController extends likePost {

    private $user_id;
    private $post_id;

    // Constructor to initialize user and post IDs
    public function __construct($user_id, $post_id) {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
    }

    // Method to like a post
    public function likePost() {
        // Check if the input is valid
        if ($this->emptyInput() == false) {
            header("Location: ../seePosts.php?error=emptyInput");
            exit();
        }

        // Optionally, check if the user has already liked the post
        if ($this->checkLike($this->user_id, $this->post_id)) {
            header("Location: ../seePosts.php?error=alreadyLiked");
            exit();
        }

        // Proceed with setting the like in the database
        $this->setLike($this->user_id, $this->post_id);
    }

    // Check if the input fields are empty
    private function emptyInput() {
        if (empty($this->user_id) || empty($this->post_id)) {
            return false;
        }
        return true;
    }
}