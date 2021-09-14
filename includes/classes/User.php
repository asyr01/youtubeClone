<?php

class User {
    private $con, $sqlData;

    public function __construct($con, $username){
        // connection variable
        $this->con = $con;
        
        // query to get user data from db
        $query = $this->con->prepare("SELECT * FROM users WHERE username = :un");
        $query->bindParam(":un", $username);
        $query->execute();
 
        // store data in the sqlData variable
        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsername() {
        return $this->sqlData["username"];
    }


}
?>