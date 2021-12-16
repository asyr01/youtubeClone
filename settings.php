<?php
require_once("inludes/header.php");
require_once("inludes/classes/Account.php");
require_once("inludes/classes/FormSanitizer.php");
require_once("inludes/classes/Constants.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}
?>