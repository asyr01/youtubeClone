<?php

class Video {
    private $con, $sqlData, $userLoggedInObj;

    public function __construct($con, $input, $userLoggedInObj){
        // connection variable
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;

        // if it's an array then it's sqlData else it's an id
        if(is_array($input)) {
            $this->sqlData = $input;
        } else {
            // query to get user data from db
            $query = $this->con->prepare("SELECT * FROM videos WHERE id = :id");
            $query->bindParam(":id", $input);
            $query->execute();       
            // instead of making a query request every time data stored in sqlData variable
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getId() {
        return $this->sqlData["id"];
    }

    public function getUploadedBy() {
        return $this->sqlData["uploadedBy"];
    }

    public function getTitle() {
        return $this->sqlData["title"];
    }

    public function getDescription() {
        return $this->sqlData["description"];
    }

    public function getPrivacy() {
        return $this->sqlData["privacy"];
    }

    public function getFilePath() {
        return $this->sqlData["filePath"];
    }

    public function getCategory() {
        return $this->sqlData["category"];
    }

    public function getUploadDate() {
        return $this->sqlData["uploadDate"];
    }

    public function getViews() {
        return $this->sqlData["views"];
    }

    public function getDuration() {
        return $this->sqlData["duration"];
    }

    // a simple function to increment the views
    public function incrementViews() {

        $query = $this-con->prepare();
    }
}
?>