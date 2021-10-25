<?php
require_once("ButtonProvider.php"); 
class CommentControls {

    private $con, $comment, $userLoggedInObj;

    public function __construct($con, $comment, $userLoggedInObj) {
        $this->con = $con;
        $this->comment = $comment;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create() {

        $replyButton = $this->createReplyButton();
        $likesCount = $this->createLikesCount();
        $likeButton = $this->createLikeButton();
        $dislikeButton = $this->createDislikeButton();
        $replySection = $this->createReplySection();

        return "<div class='controls'>
                    $likeButton
                    $dislikeButton
                </div>";
    }

    private function createReplyButton(){
        $text = "REPLY";
        $action = "toggleReply(this)";

        return ButtonProvider::createButton($text, null, $action, null);
    }

    private function createLikesCount(){
        $text = $this->comment->getLikes();
        
        // if there is no like show nothing
        if($text == 0) $text = "";

        return "<span class='likesCount'>$text</span>";
    }

    private function createReplySection(){
        return "";
    }

    // Creates a like button using ButtonProvider
    private function createLikeButton() {
        $text = $this->video->getLikes();
        $videoId = $this->video->getId();
        $action = "likeVideo(this, $videoId)";
        $class = "likeButton";

        $imageSrc = "assets/images/icons/thumb-up.png";
        
        // if video liked
        if($this->video->wasLikedBy()) {
            $imageSrc = "assets/images/icons/thumb-up-active.png";
        }

         // if video disliked
         if($this->video->wasDislikedBy()) {
            $imageSrc = "assets/images/icons/thumb-down-active.png";
        }

        return ButtonProvider::createButton("$text", "$imageSrc", "$action", "$class");
    }

    private function createDislikeButton() {
        $text = $this->video->getDislikes();
        $videoId = $this->video->getId();
        $action = "dislikeVideo(this, $videoId)";
        $class = "dislikeButton";

        $imageSrc = "assets/images/icons/thumb-down.png";
        
        // Change button image if video has been liked already
        return ButtonProvider::createButton("$text", "$imageSrc", "$action", "$class");
    }
}
?>