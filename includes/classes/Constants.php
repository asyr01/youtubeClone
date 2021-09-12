<!-- Constants stored in here, like error messages -->
<?php

class Constants {
   // sign up errors
   public static $firstNameCharacters = "Your first name must be between 2 and 25 characters";

   public static $lastNameCharacters = "Your last name must be between 2 and 25 characters";

   public static $usernameCharacters = "Your username must be between 5 and 25 characters";
   public static $usernameExists = "This username already exists in our system";

   public static $emailsDontMatch = "Emails do not match, please check again";
   public static $emailInvalid = "Email is invalid, please enter a valid email";
   public static $emailExists = "This email adress already exists in our system";

   public static $pwsDontMatch = "Passwords do not match, please check again";
   public static $pwsNotAlphanumeric = "Password can only contain letters and numbers";
   public static $pwCharacters = "Your password must be between 6 and 30 characters";

   // log in errors
   public static $loginFailed = "Your username or password was incorrect ";
   
}
?>