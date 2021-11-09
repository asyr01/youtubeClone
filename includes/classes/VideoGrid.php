<?php
class VideoGrid {
    private $con, $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = 'videoGrid';

    public function __construct($con, $userLoggedInObj) {
      $this->$con = $con;
      $this->userLoggedInObj = $userLoggedInObj;
    }
    
    //videos parameter keeps the videos that are going to be rendered, title keeps title as name explains, showfilter is either true or false to ssort the results.
    public function create($videos, $title, $showFilter) {
        if($videos == null) {
          $gridItems = $this->generateItems();
        }else {
          $gridItems = $this->generateItemsFromVideos($videos);
        }

        $header = "";

        if($title != null){
          $header = $this->createGridHeader($title, $showFilter);
        }

        return "$header
                <div class='$this->gridClass'> 
                    $gridItems
                 </div>
                ";
    }

    public function generateItems(){
        $query = $this->con->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();

        $elementsHtml = "";
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->con, $row, $this->userLoggedInObj);
        }
    }

    public function generateItemsFromVideos(){
      
    }

    public function createGridHeader($title, $showFilter) {
      return "";
    }
}

?>