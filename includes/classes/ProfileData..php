<?php

class ProfileData {
    private $con, $profileUserObj;

    public function __construct($con, $profileUserObj){
        $this->con = $con;
        $this->profileUserObj = $profileUserObj;
    }
    
}

?>