<?php require_once("includes/header.php");

// if id dpesn't match an existing one
 if(!isset($_GET["id"])) {
  echo "No URL passed into page";
  exit();
 }
 
?>

<?php require_once("includes/footer.php");?>