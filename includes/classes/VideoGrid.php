<?php
class VideoGrid {
    private $con, $userŞLoggedInObj;
    private $largeMode = false;
    private $gridClass = 'videoGrid';

    public function __construct($con, $userŞLoggedInObj) {
      $this->$con = $con;
      $this->userŞLoggedInObj = $userŞLoggedInObj;
    }
    
    //videos parameter keeps the videos that are going to be rendered, title keeps title as name explains, showfilter is either true or false to ssort the results.
    public function create($videos, $title, $showFilter) {
        if($videos == null) {
          $gridItems = $this->generateItems();
        }else {
          $gridItems = $this->generateItemsFromVideos($video);
        }
        return "<div class='$this->gridClass'> 
                    
                 </div>
                ";
    }

    public function generateItems(){

    }

    public function generateItemsFromVideos(){
      
    }

}

?>