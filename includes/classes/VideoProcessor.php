<?php
   require_once("includes/header.php");
   require_once("includes/classes/VideoUploadData.php");

class VideoProcessor {
    private $con;
    public function __construct($con){
        $this->con = $con;
    }

    public function upload($videoUploadData) {
        $targetDir = "uploads/videos/";

        // uploaded file
        $videoData = $videoUploadData->videoDataArray;

        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
        
        $tempFilePath = str_replace(" ", "_", $tempFilePath);

        $isValidData = $this->processData($videoData, $tempFilePath);

        echo $tempFilePath;
    }

    private function processData($videoData, $filePath) {
        // Takes the extension type
      $videoType = pathinfo($filePath, PATHINFO_EXTENSION);
    }
}
?>