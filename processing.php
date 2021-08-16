<?php
   require_once("includes/header.php");
   require_once("includes/classes/VideoUploadData.php");
   require_once("includes/classes/VideoProcessor.php");

   if(!isset($_POST["uploadBtn"])) {
       echo "No file sent to page.";
       exit();
   } else {
       // 1) Create file upload data
         $videoUploadData = new VideoUploadData(
             $_POST["fileInput"],
             $_POST["titleInput"],
             $_POST["descriptionInput"],
             $_POST["privacyInput"],
             $_POST["categoryInput"],
             "username"
            );
       // 2) Process video data (upload)
           $VideoProcessor = new VideoProcessor($con);
           $wasSucessful = $videoProcessor->upload($videoUploadData);

       // 3) Check if upload was sucessful
   }
?>