<?php
 require_once("includes/config.php"); 
 require_once("includes/classes/Account.php"); 
 require_once("includes/classes/Constants.php"); 
 require_once("includes/classes/FormSanitizer.php"); 
 
 // Creates an instance of Account class
 $account = new Account($con);

 if(isset($_POST["submitBtn"])) {
   $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
   $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);

   $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);

   $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
   $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);

   $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
   $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
   
   $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
 if($wasSuccessful) {
   // Success
    
   // Redirect user to index page
 }

}

// Fills form automatically when data is submitted
function getInputValue($name) {
  if(isset($_POST[$name])) {
    echo $_POST[$name];
  }
}

 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>YouTube || Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  </head>
  <body>

  <div class="signInContainer">
      <div class="column">
          <div class="header">
          <img src="assets/images/icons/youtube.png" alt="youtube logo" title="YouTube Homepage">
          <h3>Sign Up</h3>
          <span>to continue to YouTube</span>
          </div>
        
          <div class="logInForm">
            <form action="signUp.php" method="POST">
            <!-- Print error if exists  -->
        <?php echo $account->getError(Constants::$firstNameCharacters);?>
             <!-- First Name -->
            <input type="text" name="firstName" value="<?php getInputValue('firstName');?>" placeholder="First Name" autocomplete="off" required>

          <?php echo $account->getError(Constants::$lastNameCharacters)?>
            <!-- Last Name -->
              <input type="text" name="lastName" value=<?php getInputValue('lastName');?> placeholder="Last Name" autocomplete="off" required>
           
          <?php echo $account->getError(Constants::$usernameCharacters)?>
          <?php echo $account->getError(Constants::$usernameExists)?>
            <!-- Username -->
              <input type="text" name="username" value=<?php getInputValue('username');?> placeholder="Username" autocomplete="off" required>

          <?php echo $account->getError(Constants::$emailsDontMatch)?>
          <?php echo $account->getError(Constants::$emailInvalid)?>
          <?php echo $account->getError(Constants::$emailExists)?>
            <!-- Email -->
            <input type="email" name="email" value=<?php getInputValue('email');?> placeholder="Email" autocomplete="off" required>
            <!-- Confirm Email -->
            <input type="email" name="email2" value=<?php getInputValue('email2');?> placeholder="Confirm Email" autocomplete="off" required>

          <?php echo $account->getError(Constants::$pwsDontMatch)?>
          <?php echo $account->getError(Constants::$pwsNotAlphanumeric)?>
          <?php echo $account->getError(Constants::$pwCharacters)?>
            <!-- Password -->
            <input type="password" name="password" placeholder="Password" autocomplete="off" required>
            <!-- Confirm Password -->
            <input type="password" name="password2" placeholder="Confirm Password" autocomplete="off" required>
            
            <!-- Submit Button -->
            <input type="submit" name="submitBtn" value="SUBMIT" />
            </form>
          </div>
          <a class="signInMessage" href="signIn.php">Already have an account? Sign in here!</a>
      </div>
  </div>
        
  </body>
</html>