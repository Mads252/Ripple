<?php
class likePostController extends likePost {

    private $user_id;
    private $post_id;

    public function __construct($user_id, $post_id) {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
    }

    // like post funksjon
    public function likePost() {
        // Check if the input is valid
        if ($this->emptyInput() == false) {
            header("Location: ../index.php?error=emptyInput");
            exit();
        }

        // sjekker om posten er allerede liket
        if ($this->checkLike($this->user_id, $this->post_id)) {
            $this->unlike($this->user_id, $this->post_id); // Hvis liket, så kjører den unlike istedet for like
            header("Location: ../index.php?info=postUnliked");
            exit();
        }

        // Hvis den ikke er liket, så liker den
        $this->setLike($this->user_id, $this->post_id);
    }

    // sjekker om det er en user til å like og en post å like
    private function emptyInput() {
        if (empty($this->user_id) || empty($this->post_id)) {
            return false;
        }
        return true;
    }
}