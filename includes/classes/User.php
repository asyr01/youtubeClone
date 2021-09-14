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
 
        // instead of making a query request every time data stored in sqlData variable
        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsername() {
        return $this->sqlData["username"];
    }
    
    public function getFullName() {
        return $this->sqlData["firstName"] . " " . $this->sqlData["lastName"];
    }

    public function getFirstName() {
        return $this->sqlData["firstName"];
    }

    public function getLastName() {
        return $this->sqlData["lastName"];
    }

    public function getEmail() {
        return $this->sqlData["email"];
    }

    public function getProfilePic() {
        return $this->sqlData["profilePic"];
    }
    
    public function getSignUpDate() {
        return $this->sqlData["signUpDate"];
    }
}
?>