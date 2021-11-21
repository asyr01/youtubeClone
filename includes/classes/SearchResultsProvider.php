<?php

class SearchResultsProvider {
    private $con,  $userLoggedInObj;

    public function __construct($con,  $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos($term, $orderBy){
        $query = $this->con->prepare("SELECT * FROM videos WHERE title LIKE CONCAT('%', :term, '%')
                        OR uploadedBy LIKE  CONCAT('%', :term, '%') ORDER BY $orderBy");
    }
}
?> 