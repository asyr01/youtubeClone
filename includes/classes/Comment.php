<?php

require_once("ButtonProvider.php");
require_once("CommentControls.php");


class Comment {
    private $con, $sqlData, $userLoggedInObj, $videoId;

    public function __construct($con, $input, $userLoggedInObj, $videoId){
        if(!is_array($input)) {
            // if input is not an array and it's an id
            $query = $con->prepare("SELECT * FROM comments where id=:id");
            $query->bindParam(":id", $input);
            $query->execute();

            // overwrite input variable
            $input = $query->fetch(PDO::FETCH_ASSOC);
        }

      // input is sqlData at that point
      $this->sqlData = $input;
      $this->con = $con;
      $this->videoId = $videoId;
      $this->userLoggedInObj = $userLoggedInObj;

    }

    public function create() {
        $body = $this->sqlData["body"];
        $postedBy = $this->sqlData["postedBy"];
        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
        $timespan = ""; // TODO get Timespan

        $commentControlsObj = new CommentControls($this->con, $this, $this->userLoggedInObj);
        $commentControls = $commentControlsObj->create();

        return "<div class='itemContainer'>
                    <div class='comment'>
                      $profileButton
                      <div class='mainContainer'>
                        <div class='commentHeader'>
                            <a href='profile.php?username=$postedBy'>
                                <span class='username'>$postedBy</span>
                            </a>
                            <span class='timestamp'>$timespan</span>
                        </div>
                        <div class='body'>
                            $body
                        </div>
                      </div>
                    </div>
                    $commentControls
                </div>";
    }

    public function getId() {
        return $this->sqlData["id"];
    }

    public function getVideoId() {
        return $this->videoId;
    }

    public function wasLikedBy() {
        $query = $this->con->prepare("SELECT * FROM likes WHERE username=:username AND commentId=:commentId");
        $query->bindParam(":username", $username);
        $query->bindParam(":commentId", $id);
        $id = $this->getId();

        $username = $this->userLoggedInObj->getUsername();
        $query->execute();

        // returns true or false
        return $query->rowCount() > 0;
    }

    public function wasDislikedBy() {
        $query = $this->con->prepare("SELECT * FROM dislikes WHERE username=:username AND commentId=:commentId");
        $query->bindParam(":username", $username);
        $query->bindParam(":commentId", $id);
        $id = $this->getId();

        $username = $this->userLoggedInObj->getUsername();
        $query->execute();

        // returns true or false
        return $query->rowCount() > 0;
    }

    public function getLikes() {
        // This query get number of likes from DB
        $query = $this->con->prepare("SELECT count(*) as 'count' FROM likes WHERE commentId=:commentId");
        $query->bindParam(":commentId", $commentId);
        $commentId = $this->getId();
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $numLikes = $data["count"];

        // This query get number of dislikes from DB
        $query = $this->con->prepare("SELECT count(*) as 'count' FROM dislikes WHERE commentId=:commentId");
        $query->bindParam(":commentId", $commentId);
        $commentId = $this->getId();
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $numDislikes = $data["count"];

        return $numLikes - $numDislikes;
    }
}

?>