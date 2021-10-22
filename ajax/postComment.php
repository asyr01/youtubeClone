<?php
  require_once("../includes/config.php");

  // Check if a comment submitted
 if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])) {
        $query = $con->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body) VALUES(:postedBy, :videoId, :responseTo, :body)");
        $query->bindParam(":postedBy", $postedBy);
        $query->bindParam(":videoId", $videoId);
        $query->bindParam(":responseTo", $responseTo);
        $query->bindParam(":body", $commentText);
    }
 else {
     echo "One or more parameters are not passed into subscribe.php the file";
 }
?>