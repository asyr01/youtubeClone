<?php
   require_once("includes/header.php");
   require_once("includes/classes/VideoUploadData.php");


class VideoProcessor {
    private $con;
    public function __construct($con){
        $this->con = $con;
    }
}
?>