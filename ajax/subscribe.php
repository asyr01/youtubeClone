<?php
  require_once("../includes/config.php");

 if(isset($_POST['userTo']) && isset($_POST['userFrom'])) {
    // check if the user is subbed
    $userTo = $_POST['userTo'];
    $userFrom = $_POST['userFrom'];

    $query->$con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
    $query->bindParam(":userTo", $userTo);
    $query->bindParam(":userFrom", $userFrom);
    $query->execute();
    // if subbed - delete

    // if not subbed - insert

    // return new number of subs
 } else {
     echo "One or more parameters are not passed into subscribe.php the file";
 }
?>