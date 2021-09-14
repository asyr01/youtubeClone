<?php

class User {
    private $con, $sqlData;

    public function __construct($con, $username){
        $this->con = $con;

        $query = $this->con->prepare("SELECT * FROM users WHERE username = :un");
        $query->bindParam(":un", $username);
        $query->execute();
    }
}


?>