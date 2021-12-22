<?php
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoDetailsFormProvider.php");
require_once("includes/classes/VideoUploadData.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

if(!isset($_GET["videoId"])) {
    echo "No video selected";
    exit();
}

?>