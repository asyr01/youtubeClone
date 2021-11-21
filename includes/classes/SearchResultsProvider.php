<?php

class SearchResultsProvider {
    private $con,  $userLoggedInObj;

    public function __construct($con,  $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }
}
?>