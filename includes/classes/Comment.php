<?php

require_once("ButtonProvider.php");

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

    }

    public function create() {
        $body = $this->sqlData["body"];
        $postedBy = $this->sqlData["postedBy"];
        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
        $timespan = ""; // TODO get Timespan

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
                </div>";
    }
}

?>