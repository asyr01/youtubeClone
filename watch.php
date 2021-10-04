<?php 
// Video page
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoInfoSection.php");

    // If there is no id in the url
      if(!isset($_GET["id"])) {
        echo "No URL passed into page";
        exit();
      }
  
    // Video class instantiation
      $video = new Video($con, $_GET["id"], $userLoggedInObj);
      $video->incrementViews();
?>

<script src="assets/js/videoPlayerActions.js"></script>

<div class="watchLeftColumn">
   <?php
     // Create Video Player
     $videoPlayer = new VideoPlayer($video);
     echo $videoPlayer->create(true);
     
     // Create Video Info
     $VideoInfoSection = new VideoInfoSection($con, $video, $userLoggedInObj);
     echo $VideoInfoSection->create();
    ?>
</div>

<div class="suggestions">
  
</div>

<?php require_once("includes/footer.php"); ?>