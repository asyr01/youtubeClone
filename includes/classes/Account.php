<!-- Inserts data, Validates the data entered, if first name is more than 2 char, username is already exist etc -->

<?php

class Account {
  private $con;
  private $errArray = array();

  public function __construct($con){
      $this->con = $con;
  }
  
  // Register user to the site. Insert info to table. 
  public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
    $this->validateFirstName($fn);
    $this->validateLastName($ln);
    $this->validateUsername($un);
  }

  // Validate first name
  private function validateFirstName($fn) {
    if(strlen($fn) > 25 || strlen($fn) < 2 ) {
        array_push($this->errArray, Constants::$firstNameCharacters);
    }
  }

  // Validate last name
  private function validateLastName($ln) {
    if(strlen($ln) > 25 || strlen($ln) < 2 ) {
        array_push($this->errArray, Constants::$lastNameCharacters);
    }
  }

  // Validate username if it fails return, if passes then check if exists.
  private function validateUsername($un) {
    if(strlen($un) > 25 || strlen($un) < 5 ) {
        array_push($this->errArray, Constants::$usernameCharacters);
        return;
    }
    // Checks if selected username exists in table
    $query = $this->con->prepare("SELECT username FROM users WHERE username=:un");
    $query->bindParam(":un", $un);
    $query->execute();
    // If query returns a row, print error
    if($query->rowCount() !=0){
      array_push($this->errArray, Constants::$usernameExists);
    }
  }

  // Prints error outputs
  public function getError($error) {
    // If found in array
    if(in_array($error, $this->errArray)) {
        return "<span class='errorMessage'>$error</span>";
    }
  }
}
?>