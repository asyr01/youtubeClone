<?php 
require_once("includes/header.php");
require_once("includes/classes/Video.php");

// if id dpesn't match an existing one
 if(!isset($_GET["id"])) {
  echo "No URL passed into page";
  exit();
 }
  
   // Video class instantiation
  $video = new Video($con, $_GET["id"], $userLoggedInObj);
  echo $video->getTitle();
?>

<?php require_once("includes/footer.php"); ?>