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

if(isset($_POST["saveDetailsButton"])) {
    $account = new Account($con);

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormString($_POST["email"]);
    
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
}

if(isset($_POST["savePasswordButton"])) {
    
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
        <?php
            echo $formProvider->createPasswordsForm();  
        ?>
    </div>
</div>

