<?php
   require_once("includes/header.php");

   if(!isset($_POST["uploadButton"])) {
       echo "No file sent to page.";
       exit();
   }
?>