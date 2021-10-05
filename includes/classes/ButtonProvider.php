 <!-- Creates a buton with passed parameters -->
<?php

class ButtonProvider {

// Variable for changing the action
public static $signInFunction = "notSignedIn()";

// Change action if user not logged in
public static function createLink($link) {
    return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
}

public static function createButton($text, $imageSrc, $action, $class ) {
        // Checks if image source passed
        $image = ($imageSrc == null) ? "": "<img src='$imageSrc'>";

        // Change action if needed if they are not logged in redirect them
        $action = ButtonProvider::createLink($action);

        return "<button class='$class' onclick='$action'>
         $image
         <span class='text'>$text</span>
        </button>";
}


public static function createUserProfileButton($con, $username) {
        $userObj = new User($con, $username);
        $profilePic = $userObj->getProfilePic();
        $link = "profile.php?username=$username";

        return "
            <a href='$link'>
               <img src='$profilePic' class='profilePicture'>
            </a>
            ";
      }

}

?>