<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/SettingsFormProvider.php");
require_once("includes/classes/Constants.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

$detailsMessage = "";
$passwordMessage = "";
$formProvider = new SettingsFormProvider();

// When saveDetailsButton clicked
if(isset($_POST["saveDetailsButton"])) {
    $account = new Account($con);

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    
    // Update details method called, returns true or false
    if($account->updateDetails($firstName, $lastName, $email, $userLoggedInObj->getUsername())) {
        // succesfully updated
        $detailsMessage = "
            <div class='alert alert-success'>
                <b>User details succesfully updated.</b>
            </div>
        ";
    } else {
        // error
        $errorMessage = $account->getFirstError();
        // if, else condition occured in the getFirstError
        if($errorMessage == "") $errorMessage = "Something went wrong";

        $detailsMessage = "
            <div class='alert alert-danger'>
                <b>User details can't be updated at the moment.</b>
                <p>$errorMessage</p>
            </div>
        ";
    }

    // Refresh the page
    header("Refresh:4");
}

if(isset($_POST["savePasswordButton"])) {
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
    $newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);
    
    // Update details method called, returns true or false
    if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedInObj->getUsername())) {
        // succesfully updated
        $passwordMessage = "
            <div class='alert alert-success'>
                <b>Password succesfully updated.</b>
            </div>
        ";
    } else {
        // error
        $errorMessage = $account->getFirstError();
        // if, else condition occured in the getFirstError
        if($errorMessage == "") $errorMessage = "Something went wrong";

        $passwordMessage = "
            <div class='alert alert-danger'>
                <b>Password can't be updated at the moment.</b>
                <p>$errorMessage</p>
            </div>
        ";
 }
}

?>

<div class='settingsContainer column'>
    <div class='formSection'>
        <div class='message'>
            <?php echo $detailsMessage?>
        </div>
        <?php
            echo $formProvider->createUserDetailsForm(
                isset($_POST["firstName"]) ? $_POST["firstName"] : $userLoggedInObj->getFirstName(),
                isset($_POST["lastName"]) ? $_POST["lastName"] : $userLoggedInObj->getLastName(),
                isset($_POST["email"]) ? $_POST["email"] : $userLoggedInObj->getEmail()
            );   
        ?>
    </div>

    <div class='formSection'>
        <div class='message'>
            <?php echo $passwordMessage?>
        </div>
        <?php
            echo $formProvider->createPasswordsForm();  
        ?>
    </div>
</div>