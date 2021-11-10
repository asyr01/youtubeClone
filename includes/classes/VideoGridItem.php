<?php
class VideoGridItem {
    private $video, $largeMode;
    public function __construct($video, $largeMode){
        $this->video = $video;
        $this->largeMode = $largeMode;
    }

    public function create() {
        $thumbnail = $this->createThumbnail();
        $details = $this->createDetails();
        $url = "watch.php?id=" . $this->video->getId();
        return "
        
        ";
    }

    private function createThumbnail() {
        return "
        
        ";
    }

    private function createDetails() {
        return "
        
        ";
    }
}

?>
