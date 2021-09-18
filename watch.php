<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");

// if id dpesn't match an existing one
 if(!isset($_GET["id"])) {
  echo "No URL passed into page";
  exit();
 }
  
   // Video class instantiation
  $video = new Video($con, $_GET["id"], $userLoggedInObj);
  $video->incrementViews();
  
?>

<div class="watchLeftColumn">
   <?php
     $videoPlayer = new VideoPlayer($video);
     echo $videoPlayer->create(true);
    ?>
</div>

<?php require_once("includes/footer.php"); ?>