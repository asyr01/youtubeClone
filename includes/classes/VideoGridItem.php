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
          <a href ='$url'>
            <div class='videoGridItem'>
                 $thumbnail
                 $details
            </div>
          </a>
        ";
    }

    private function createThumbnail() {
        return "
            TEST
        ";
    }

    private function createDetails() {
        return "
            ED
        ";
    }
}

?>
