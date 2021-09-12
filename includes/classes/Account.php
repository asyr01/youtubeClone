<!-- Inserts data, Validates the data entered, if first name is more than 2 char, username is already exist etc -->

<?php

require_once('../classes/Constants.php');

class Account {
  private $con;
  private $errArray = array();

  
  public function __construct($con){
      $this->con = $con;
  }

   public function login($un, $pw){
   // Hash the password to compare stored one.
   $pw = hash("sha512", $pw);

   // Check DB to validate credentials
   $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
   $query->bindParam(':un', $un);
   $query->bindParam(':pw', $pw);

   // If it returns a row, so it means it found a user in db login will be succesful.
   $query->execute();
   if($query->rowCount() == 1){
     return true;
   } else {
     array_push($this->errArray, Constants::$loginFailed);
     return false;
   }

  }
  
  // Register user to the site. Insert info to table. 
  public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
    $this->validateFirstName($fn);
    $this->validateLastName($ln);
    $this->validateUsername($un);
    $this->validateEmails($em, $em2);
    $this->validatePasswords($pw, $pw2);

    if(empty($this->errArray)){
       return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
    } else {
      return false;
    }
  }
  
  // Inserts user data to the table
  public function insertUserDetails($fn, $ln, $un, $em, $pw) {
      // Hash the password
      $pw = hash("sha512", $pw);

      // default profile pic
      $profilePic = "assets/images/profilePictures/default.png";

      // Query to insert the users' data
      $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password, profilePic) 
      VALUES (:fn, :ln, :un, :em, :pw, :pic)");

      // Bind values to the placeholders
      $query->bindParam(':fn', $fn);
      $query->bindParam(':ln', $ln);
      $query->bindParam(':un', $un);
      $query->bindParam(':em', $em);
      $query->bindParam(':pw', $pw);
      $query->bindParam(':pic', $profilePic);

      // Execute the query
      return $query->execute();
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

   // Validate emails if emails matches, then check if it already exists.
   private function validateEmails($em, $em2) {
    if($em != $em2) {
        array_push($this->errArray, Constants::$emailsDontMatch);
        return;
    }
    
    // Built-in php filter, checks if valid.
    if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
      array_push($this->errArray, Constants::$emailInvalid);
        return;
    };

    // Checks if selected username exists in table
    $query = $this->con->prepare("SELECT email FROM users WHERE email=:em");
    $query->bindParam(":em", $em);
    $query->execute();
    // If query returns a row, print error
    if($query->rowCount() !=0){
      array_push($this->errArray, Constants::$emailExists);
    }
  }

  // Validate passwords if passwords matches, then check if it includes characters.
  private function validatePasswords($pw, $pw2) {
      if($pw != $pw2) {
          array_push($this->errArray, Constants::$pwsDontMatch);
          return;
      }

      // only numbers and letters. -special characters don't really make much safer. preg_match cheks if password matches the reg exp.
      if(preg_match("/[^A-Za-z0-9]/", $pw)) {
        array_push($this->errArray, Constants::$pwsNotAlphanumeric);
        return;
     }
     
     // Check lengt of password
     if(strlen($pw) > 30 || strlen($pw) < 6 ) {
      array_push($this->errArray, Constants::$pwCharacters);
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