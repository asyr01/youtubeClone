<?php
   require_once("includes/header.php");
   require_once("includes/classes/VideoUploadData.php");

class VideoProcessor {
    // sql connection variable
    private $con;
    // 5gb size limit.
    private $sizeLimit = 500000000;
    // supported file types
    private $allowedTypes = array("mp4", "flv", "webm", "mkv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");


    public function __construct($con){
        $this->con = $con;
    }

    public function upload($videoUploadData) {
        $targetDir = "uploads/videos/";

        // uploaded file
        $videoData = $videoUploadData->videoDataArray;
        // append an unique id
        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
        // replace blankspace with underscore
        $tempFilePath = str_replace(" ", "_", $tempFilePath);
        
        // returns true or false
        $isValidData = $this->processData($videoData, $tempFilePath);
        
        if(!$isValidData) {
            return false;
        }
        
        // if everything is okay move the file
        if(move_uploaded_file($videoData["tmp_name"], $tempFilePath)) {
           echo "File moved successfully";
        }
    }

    // Checks if data is appropriate for being uploaded
    private function processData($videoData, $filePath) {
        // Takes the extension type
      $videoType = pathinfo($filePath, PATHINFO_EXTENSION);
      if(!$this->isValidSize($videoData)) {
            echo "File is too large. Can't be more than." . $this -> sizeLimit . "bytes";
            return false;
      }else if(!$this->isValidType($videoType)) {
          echo "Invalid file type";
          return false;
      }else if($this->hasError($videoData)) {
          echo "Error code: " . $videoData["error"];
          return false;
      }
      return true;
    }

    // Checks file size
    private function isValidSize($data) {
        return $data["size"] <= $this->sizeLimit;
    }
    
    // Checks file type
    private function isValidType($type) {
        $lowercased = strtolower($type);
        return in_array($lowercased, $this->allowedTypes);
    }
    
    // Checks if there is another error
    private function hasError($data) {
      return $data["error" ] != 0;
    }
}
?>