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
      $this->userLoggedInObj = $userLoggedInObj;
      $this->videoId = $videoId;
    }

    public function create() {
        $id = $this->sqlData["id"];
        $videoId = $this->getVideoId();
        $body = $this->sqlData["body"];
        $postedBy = $this->sqlData["postedBy"];
        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
        $timespan = $this->time_elapsed_string($this->sqlData["datePosted"]);

        $commentControlsObj = new CommentControls($this->con, $this, $this->userLoggedInObj);
        $commentControls = $commentControlsObj->create();

        $numResponses =  $this->getNumberOfReplies();

        if($numResponses > 0) {
            $viewRepliesText = "<span class='repliesSection viewReplies' onclick='getReplies($id, this, $videoId)'>
              View all $numResponses replies
            </span>";
        } else {
            $viewRepliesText = "<div class='repliesSection'><div>";
        }

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
                    $viewRepliesText
                </div>";
    }

   
    public function getNumberOfReplies() {
        // responseTo is video id comment belongs to
        $query = $this->con->prepare("SELECT count(*) as 'count' FROM comments WHERE responseTo=:responseTo");
        $query->bindParam(":responseTo", $id);
        $id= $this->sqlData["id"];
        $query->execute();

        // The fetchColumn() method returns the value of the column specified by the $column index. If the result set has no more rows, the method returns false.
        return $query->fetchColumn();
    }

    public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
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

    
    public function like() {
        $id = $this->getId();
        $username = $this->userLoggedInObj->getUsername();
        
        // If a row returns from query executed, so user liked the video.
        if($this->wasLikedBy()) {
            // User has already liked
            $query = $this->con->prepare("DELETE FROM likes WHERE username=:username AND commentvideoId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            // will return one number unlike video like dislike.
            return -1;
        }
        else {
            // Delete if it was a dislike
            $query = $this->con->prepare("DELETE FROM dislikes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();


            // count will return one if there is a dislike
            $count = $query->rowCount();

            // insert a like to the likes table
            $query = $this->con->prepare("INSERT INTO likes(username, commentId) VALUES(:username, :commentId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $id);
            $query->execute();

            return 1 + $count;
        }
    }
}

?>