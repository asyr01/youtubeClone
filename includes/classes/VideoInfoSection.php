<?php
require_once("includes/classes/VideoInfoControls.php"); 
class VideoInfoSection {

    private $con, $video, $userLoggedInObj;

    public function __construct($con, $video, $userLoggedInObj){
        $this->video = $video;
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }
    
    public function create() {
        return $this->createPrimaryInfo() . $this->createSecondaryInfo();
      }
    
    // createPrimaryInfo includes title views like/dislike.
    private function createPrimaryInfo() {
        $title = $this->video->getTitle();
        $views = $this->video->getViews();
        
        $videoInfoControls = new VideoInfoControls($this->video, $this->userLoggedInObj);
        $controls = $videoInfoControls->create();

        return "<div class='videoInfo'>
                <h1>$title</h1>
                 <div class='bottomSection'>
                  <span class='viewCount'>$views</span>
                  $controls
                 </div>
                </div>";
    }

    // createSecondaryInfo includes  who uploaded it, subscribe, upload date.
    private function createSecondaryInfo(){

    }

}

?>