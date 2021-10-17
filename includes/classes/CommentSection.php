<?php

class CommentSection {
    private $con, $video, $userLoggedInObj;

    public function __construct($con, $video, $userLoggedInObj){
        $this->video = $video;
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }
    
    public function create() {
        return $this->createCommentSection();
      }

      private function createCommentSection() {
        // variable keeps number of comments that returned from db
        $numComments =  $this->video->getNumberOfComments();
        $postedBy = $this->userLoggedInObj->getUsername();
        $videoId = $this->video->getId();

        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
        $commentAction = "postComment(this, '$postedBy', $videoId, null, 'comments')";

        $commentButton = ButtonProvider::createUserProfileButton("COMMENT", null, $commentAction, "postComment");

        echo $numComments;
      }

}

?>