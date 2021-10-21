<?php
  require_once("../includes/config.php");

  // Check if a comment submitted
 if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])) {
        echo "success";
    }
 else {
     echo "One or more parameters are not passed into subscribe.php the file";
 }
?>