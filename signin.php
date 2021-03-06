<?php 

require_once("includes/config.php");
require_once("includes/classes/Account.php"); 
require_once("includes/classes/Constants.php"); 
require_once("includes/classes/FormSanitizer.php"); 

 // Creates an instance of Account class
 $account = new Account($con);
  
if(isset($_POST["submitBtn"])) {
  $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
  $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
  
 
  $wasSuccessful = $account->login($username, $password);

  if($wasSuccessful) {
  // Store username into a session variable
     $_SESSION["userLoggedIn"] = $username;
  // Redirect user to index page
     header("Location: index.php");
   } else {
    // fail
   }

}

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
    <title>YouTube || Sign In</title>
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
          <h3>Sign In</h3>
          <span>to continue to YouTube</span>
          </div>

          <div class="logInForm">
            <form action="signIn.php" method="POST">
              <!-- Username -->
          <?php echo $account->getError(Constants::$loginFailed); ?>
            <input type="text" name="username" placeholder="Username" value="<?php getInputValue('username');?>" required autocomplete="off">
              <!-- Password -->
            <input type="password" name="password" placeholder="Password" required>
             <!-- Button -->
             <input type="submit" name="submitBtn" value="SUBMIT">
            </form>
          </div>

          <a class="signInMessage" href="signUp.php">Don't have an account? Sign up here!</a>
      </div>
  </div>
        
  </body>
</html>