<?php

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
      // if input is sqlData
      $this->sqlData = $input;
    }
}

?>