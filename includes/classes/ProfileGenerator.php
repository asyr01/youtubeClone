<?php

class ProfileGenerator {

    private $con, $userLoggedInObj, $profileUsername;

    public function __construct($con, $userLoggedInObj, $profileUsername){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->profileUsername = $profileUsername;
    }

    public function create() {
        
    }


}

?>