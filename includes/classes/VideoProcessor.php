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

    }
}
?>