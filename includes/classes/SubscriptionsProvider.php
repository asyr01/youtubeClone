<?php

class SubscriptionsProvider {
    private $con,  $userLoggedInObj;

    public function __construct($con,  $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos() {
        $videos = array();
        // Contains all people with subscribeTo
        $subscriptions = $this->userLoggedInObj->getSubscriptions();

        if(sizeof($subscriptions) > 0) {
       
        $condition = "";
        $i = 0;

       //   $query = "SELECT * FROM videos WHERE uplaodedBy = user1 or uplaodedBy = user2 OR uplaodedBy = user3";
       //   $query->bindParam(1, "user1");
       //   $query->bindParam(2, "user2");
       //   $query->bindParam(3, "user3");
        //Loop adds finded user to query to get all videos user 1, user2, user3
        while($i < sizeof($subscriptions)) {
           if($i== 0) {
               // when it's the first loop
               $condition = "WHERE uploadedBy=?";
           } else {
               $condition = " OR uploadedBy=?";
           }
           $i++;
         }
         $videoSql = "SELECT * FROM videos $condition ORDER BY uploadDate DESC";
         $videoQuery = $this->con->prepare($videoSql);
         $i = 1;

         foreach($subscriptions as  $sub) {
             $videoQuery->bindParam($i, $subUsername);
             $subUsername = $sub->getUsername();
             $i++;
         }

         $videoQuery->execute();
         while($row = $videoQuery->fetch(PDO::FETCH_ASSOC)) {
             $video = new Video($this->con, $row, $this->userLoggedInObj);
             array_push($videos, $video);
         }

       }
        return $videos;
    }
}
?>