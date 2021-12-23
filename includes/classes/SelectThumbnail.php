<?php

class SelectThumbnail {

    private $con, $video;

    public function __construct($con, $video) {
        $this->con = $con;
        $this->video = $video;
    }

    public function create() {
        $thumbnailData = $this->getThumbnailsData();
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

    }

}

?>