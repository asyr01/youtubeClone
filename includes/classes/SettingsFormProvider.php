<?php 

class SettingsFormProvider {

    public function createUserDetailsForm($firstName, $lastName, $email) {
        $firstNameInput = $this->createFirstNameInput($firstName);
        $lastNameInput = $this->createLastNameInput($lastName);
        $emailInput = $this->createEmailInput($email);
        $saveButton = $this->createSaveUserDetailsButton();


        return "<form action='settings.php' method='POST' enctype='multipart/form-data'> 
                <span class='title'>User details</span>
                     $firstNameInput
                     $lastNameInput
                     $emailInput
                     $saveButton
               </form>
        ";
    }

    
    public function createPasswordsForm() {
        $oldPasswordInput = $this->createPasswordInput("oldPassword", "Old password");
        $newPasswordInput = $this->createPasswordInput("newPassword", "New password");
        $newPassword2Input = $this->createPasswordInput("newPassword2", "Confirm new password");
        $saveButton = $this->createSavePasswordButton();


        return "<form action='settings.php' method='POST' enctype='multipart/form-data'> 
                     <span class='title'>Change password</span>
                     $oldPasswordInput
                     $newPasswordInput 
                     $newPassword2Input
                     $saveButton
               </form>
        ";
    }

  private function createFirstNameInput($value) {
        if($value == null) $value = "";
        return "<div class='form-group'>
            <input class='form-control' type='text' placeholder='First Name' name='firstName' value='$value' required>
        </div>";
  }

  private function createEmailInput($value) {
    if($value == null) $value = "";
    return "<div class='form-group'>
        <input class='form-control' type='email' placeholder='Email' name='email' value='$value' required>
    </div>";
 }

 private function createLastNameInput($value) {
    if($value == null) $value = "";
    return "<div class='form-group'>
        <input class='form-control' type='text' placeholder='Last Name' name='lastName' value='$value' required>
    </div>";
 }

 private function createSaveUserDetailsButton() {
    return "
    <div class='col-md-12 text-center'>
        <button type='submit' class='btn btn-primary' name='saveDetailsButton'>
            Save
        </button>
    </div>
    ";
 }
 
 // Password change settings

 private function createSavePasswordButton() {
    return "
    <div class='col-md-12 text-center'>
        <button type='submit' class='btn btn-primary' name='savePasswordButton'>
            Save
        </button>
    </div>
    ";
 }
 
 private function createPasswordInput($name, $placeholder) {
    return "<div class='form-group'>
        <input class='form-control' type='password' placeholder='$placeholder' name='$name' required>
    </div>";
}
}
?>