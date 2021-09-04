<!-- Inserts data, Validates the data entered, if first name is more than 2 char, username is already exist etc -->

<?php
class Account {
  private $con;

  public function __construct($con){
      $this->con = $con;
  }
  
  // Register user to the site. Insert info to table. 
  public function register($fn, $ln, $un, $em, $em2, $pw, $pw2) {
    echo $fn . "\n";
    echo $ln . "\n";
    echo $un . "\n";
    echo $em . "\n";
    echo $em2. "\n";
    echo $pw . "\n";
    echo $pw2 . "\n";
  }

}
?>