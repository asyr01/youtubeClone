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
             $_FILES["fileInput"],
             $_POST["titleInput"],
             $_POST["descriptionInput"],
             $_POST["privacyInput"],
             $_POST["categoryInput"],
             $userLoggedInObj->getUsername()
            );
       // 2) Process video data (upload)
            // returns true or false, 3 depends on that to send message
           $VideoProcessor = new VideoProcessor($con);
           $wasSucessful = $VideoProcessor->upload($videoUploadData);

       // 3) Check if upload was sucessful
       if($wasSucessful) {
           echo "Uploaded Sucessfully";
       }
   }
?>