<?php

class SelectThumbnail {

    private $con, $video;

    public function __construct($con, $video) {
        $this->con = $con;
        $this->video = $video;
    }

    public function create() {
        $thumbnailData = $this->getThumbnailsData();
        $html = "";

        foreach($thumbnailData as $data) {
            $html .= $this->createThumbnailItem($data);
        }

        return "<div class='thumbnailItemsContainer'>
                    $html
                </div>
        ";
    }

    private function createThumbnailItem($data) {
         $id = $data["id"];
         $url = $data["filePath"];
         $videoId = $data["videoId"];
         $selected = $data["selected"] == 1 ? "selected" : "";

         return "
          <div class='thumbnailItem $selected' onclick='setNewThumbnail($id, $videoId, this)'>
            <img src='$url'>
          </div>
         ";
    }

    private function getThumbnailsData() {
        $data = array();

        $query = $this->con->prepare("SELECT * FROM thumbnails WHERE videoId = :videoId");
        $query->bindParam(":videoId", $videoId);
        $videoId = $this->video->getId();

        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // array_push($data, $row);
            $data[] = $row;
        }
        
        return $data;
    }

}

?>