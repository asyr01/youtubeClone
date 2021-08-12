<?php 
ob_start(); // turns on output buffering
date_default_timezone_set('Europe/Istanbul'); // Sets Timezone

// Try & Catch statement for PDO connection
try {
// con is connection variable, after comma username and password comes.
 $con = new PDO("mysql:dbname=youtubeclone;host=localhost", "root", "");
// Errors to debug
 $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch(PDOException $e) {
   echo "Connection failed: ", $e->getMessage();
}
?>