<?php
require_once("includes/header.php");

if(isset($_GET["username"])) {
    $profileUsername = $_GET["username"];
}

?>

<div><?php echo $profileUsername?></div>