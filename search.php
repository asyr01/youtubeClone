<?php

require_once("includes/header.php");

if(!isset($_GET["term"]) || $_GET["term"] == "") {
  echo "You must enter a search term";
  exit();
}
?>



<?php

require_once("includes/footer.php");

?>