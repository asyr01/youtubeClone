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


    // returns true if user logged in 
    public static function isLoggedIn() {
        return isset($_SESSION["userLoggedIn"]);
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
    
    // Check if one subscribes
    public function isSubscribedTo($userTo) {
      $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo = :userTo AND userFrom = :userFrom");
      $query->bindParam(":userTo", $userTo);
      $query->bindParam(":userFrom", $username);
      $username = $this->getUsername();
      $query->execute();

      // return true or false
      return $query->rowCount() > 0;
    }

    public function getSubscriberCount() {
      $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo = :userTo");
      $query->bindParam(":userTo", $username);
      $username = $this->getUsername();
      $query->execute();
      
      // returns number of rows -subscribers-
      return $query->rowCount();
    }

    // returns subscriptions as an array
    public function getSubscriptions() {
        $query = $this->con->prepare("SELECT userTo FROM subscribers WHERE userFrom = :userFrom");
        $username = $this->getUsername();
        $query->bindParam(":userFrom", $username);
        $query->execute();

        $subs = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($this->con, $row["userTo"]);
            array_push($subs, $user);
        }
        return $subs;
    }
}
?>