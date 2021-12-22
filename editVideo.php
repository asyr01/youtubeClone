<?php
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoDetailsFormProvider.php");
require_once("includes/classes/VideoUploadData.php");

// Checks if user logged im
if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

// Checks if there is videoId parameter at the url bar.
if(!isset($_GET["videoId"])) {
    echo "No video selected";
    exit();
}

$video = new Video($con,$_GET["videoId"],$userLoggedInObj);
if($video->getUploadedBy() != $userLoggedInObj->getUsername()) {
    echo "You are not allowed to perform this action";
    exit();
}

?>