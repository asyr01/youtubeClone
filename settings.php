<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/SettingsFormProvider.php");
require_once("includes/classes/Constants.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

$formProvider = new SettingsFormProvider();

?>

<div class='settingsContainer column'>
    <div class='formSection'>
        <?php
            echo $formProvider->createUserDetailsForm(
                isset($_POST["firstName"]) ? $_POST["firstName"] : $userLoggedInObj->getFirstName(),
              
            );   
        ?>
    </div>

    <div class='formSection'>
        <?php
            echo $formProvider->createPasswordsForm();  
        ?>
    </div>
</div>
