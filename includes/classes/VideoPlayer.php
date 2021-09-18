<?php 

class VideoPlayer {

private $video;

public function __construct($video){
    $this->video = $video;
}

public function create($autoPlay) {
    if($autoPlay) {
        $autoPlay = "autoplay";
    } else {
        $autoPlay = "";
    }
}

}
?>