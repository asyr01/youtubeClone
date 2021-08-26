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
    private $ffmpegPath;
    private $ffprobePath;


    public function __construct($con){
        $this->con = $con;
        $this->ffmpegPath = realpath("ffmpeg/windows/ffmpeg.exe");
        $this->ffprobePath = realpath("ffmpeg/windows/ffprobe.exe");
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
          $finalFilePath = $targetDir . uniqid() . ".mp4";

          if(!$this->insertVideoData($videoUploadData, $finalFilePath)) {
              echo "Insert query failed";
              return false;
          }

          if(!$this->convertVideoToMp4($tempFilePath, $finalFilePath)) {
              echo "Upload Failed.";
              return false;
          } 

          if(!$this->deleteFile($tempFilePath)) {
            echo "Deleting Failed.";
            return false;
        } 

        if(!$this->generateThumbnails($finalFilePath)) {
            echo "Couldn't generate thumbnails";
            return false;
        } 
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
    
    // Insert data to the table
    private function insertVideoData($uploadData, $filePath) {
      $query = $this->con->prepare("INSERT INTO videos(title, uploadedBy, description, privacy, category, filePath)
       VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)");

       $query->bindParam(":title", $uploadData->title);
       $query->bindParam(":uploadedBy", $uploadData->uploadedBy);
       $query->bindParam(":description", $uploadData->description);
       $query->bindParam(":privacy", $uploadData->privacy);
       $query->bindParam(":category", $uploadData->category);
       $query->bindParam(":filePath", $filePath);
       
       return $query->execute();
    }

    public function convertVideoToMp4($tempFilePath, $finalFilePath) {
        // Command to run the convertion operation
        $cmd = "$this->ffmpegPath -i $tempFilePath $finalFilePath 2>&1";

        $outputLog = array();
        exec($cmd, $outputLog, $returnCode);

        // Check if there is error and print output
        if($returnCode != 0) {
            // Command failed
            foreach($outputLog as $line) {  
                echo $line . "<br>";
            }
           return false;
       }
       return true;
    }

    private function deleteFile($filePath) {
        if(!unlink($filePath)){
            echo "Could not delete file\n;";
            return false;
        }
        return true;
    }

    public function generateThumbnails($filePath) {
        // Youtube uses this ratio
        $thumbnailSize = "210x118";
        // Get the duartion with ffprobe, and get thumbnails as many as specified.
        $numThumbNails = 3;
        $pathToThumbnail = "uploads/videos/thumbnails";

        $duration = $this->getVideoDuration($filePath);

        // returns id of the row which is just inserted
        $videoId = $this->con->lastInsertId();

        $this->updateDuration($duration, $videoId);

        echo "duration: $duration";
        return true;
    }
    
    // returns duration unformatted.
    private function getVideoDuration($filePath) {
        return shell_exec("$this->ffprobePath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $filePath");
    }
      
    // formats the duration.
    private function updateDuration($duration, $videoId) {
        // 3600 is the number of seconds in one hour
       $hours = floor($duration / 3600);
        // duration minus hours then divide 60 to calculate minutes
       $mins = floor($duration - ($hours * 3600) / 60);
        // what remains after dividing 60
       $secs = floor($duration % 60);

       $hours = ($hours < 1) ? "00" : $hours . ":";
       $mins = ($mins < 10) ? "0" . $mins . ":" : $mins . ":";
       $secs = ($secs < 10) ? "0" . $secs : $secs;

       $duration = $hours.$mins.$secs;

       $query = $this->con->prepare("UPDATE videos SET duration=:duration WHERE id=:videoId");
       $query->bindParam(":duration", $duration);
       $query->bindParam(":videoId", $videoId);
    }
}

?>