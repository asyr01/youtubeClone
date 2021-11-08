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
        return "<div class='$this->gridClass'> 
                    
                 </div>
                ";
    }
}

?>