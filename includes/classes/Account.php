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

  // Prints error outputs
  public function getError($error) {
    // If found in array
    if(in_array($error, $this->errArray)) {
        return "<span class='errorMessage'>$error</span>";
    }
  }
}
?>