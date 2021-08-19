<?php
   require_once("includes/header.php");
   require_once("includes/classes/VideoUploadData.php");

class VideoProcessor {
    private $con;
    
    // 5gb size limit.
    private $sizeLimit = 500000000;


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
      if(!$this->isValidSize($videoData)) {
            echo "File is too large. Can't be more than." . $this -> sizeLimit . "bytes";
            return false;
      }
      else if(!$this->isValidType($videoType)) {
          
      }
    }

    private function isValidSize($data) {
        return $data["size"] <= $this->sizeLimit;
    }

    private function isValidType($type) {
        $lowercased = strtolower($type)
    }
}
?>