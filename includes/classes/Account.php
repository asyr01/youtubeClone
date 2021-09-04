<!-- Inserts data, Validates the data entered, if first name is more than 2 char, username is already exist etc -->

<?php
require_once('./Constants.php');

class Account {
  private $con;
  private $errArray = array();

  public function __construct($con){
      $this->con = $con;
  }
  
  // Register user to the site. Insert info to table. 
  public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
    $this->validateFirstName($fn);
  }

  // Validate first name
  private function validateFirstName($fn) {
    if(strlen($fn) > 24 || strlen($fn) < 2 ) {
        array_push($this->errArray, Constants::$firstNameCharacters);
    }
  }
}
?>