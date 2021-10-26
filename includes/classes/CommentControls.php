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
        $videoId = $this->comment->getId();
        $commentId = $this->comment->getId();
        $action = "likeComment($commentId,this, $videoId)";
        $class = "likeButton";

        $imageSrc = "assets/images/icons/thumb-up.png";
        
        // if comment liked
        if($this->comment->wasLikedBy()) {
            $imageSrc = "assets/images/icons/thumb-up-active.png";
        }
        return ButtonProvider::createButton("", "$imageSrc", "$action", "$class");
    }

    private function createDislikeButton() {
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getId();
        $action = "dislikeComment($commentId,this, $videoId)";
        $class = "dislikeButton";

        $imageSrc = "assets/images/icons/thumb-down.png";

        // if comment disliked
        if($this->comment->wasDislikedBy()) {
            $imageSrc = "assets/images/icons/thumb-down-active.png";
        }
        
        // Change button image if video has been liked already
        return ButtonProvider::createButton("", $imageSrc, $action, $class);
    }
}
?>