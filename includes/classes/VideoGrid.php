<?php
class VideoGrid {
    private $con, $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = 'videoGrid';

    public function __construct($con, $userLoggedInObj) {
      $this->con = $con;
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
            $item = new VideoGridItem($video, $this->largeMode);
            $elementsHtml .= $item->create();
        }
        return $elementsHtml;
    }


    // takes videos as an array then generate gridItems from them.
    public function generateItemsFromVideos($videos){
        $elementsHtml = "";

        foreach($videos as $video){
          $item = new VideoGridItem($video, $this->largeMode);
          $elementsHtml .= $item->create();
        }

        return $elementsHtml;
    }

    public function createGridHeader($title, $showFilter) {
      $filter = "";

      if($showFilter) {
        $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $urlArray = parse_url($link);
        $query = $urlArray["query"];
      }

      return "<div class='videoGridHeader'>
                   <div class='left'>$title</div>
                   $filter
                 </div>";
    }

    public function createLarge($videos, $title, $showFilter) {
      // add the class of large and overwrite largeMode
      $this->gridClass .= " large";
      $this->largeMode = true;
      return $this->create($videos, $title, $showFilter);
    }
}

?>