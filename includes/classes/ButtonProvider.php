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

        return "
        <button class='$class' onclick='$action'>
            $image
         <span class='text'>$text</span>
        </button>
        ";
}

public static function createHyperlinkButton($text, $imageSrc, $href, $class) {
    // Checks if image source passed
    $image = ($imageSrc == null) ? "": "<img src='$imageSrc'>";
    return "
    <a href='$href'>
        <button class='$class'>
          $image
          <span class='text'>$text</span>
        </button>
    </a>
    ";
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

public static function createEditVideoButton($videoId) {
    $href = "editVideo.php?videoId=$videoId";
    $button = ButtonProvider::createHyperlinkButton("EDIT VIDEO", null, $href, "edit button");
    return "
        <div class='editVideoButtonContainer'>
            $button
        </div>
    ";
 }

 // Create a subscribe or unsubscribe button by checking with isSubscribedTo
 public static function createSubscriberButton($con, $userToObj, $userLoggedInObj) {
    $userTo = $userToObj->getUsername();
    $userLoggedIn = $userLoggedInObj->getUsername();

    $isSubscribedTo = $userLoggedInObj->isSubscribedTo($userTo);
    $buttonText = $isSubscribedTo ? "SUBSCRIBED" : "SUBSCRIBE";
    $buttonText .= " " . $userToObj->getSubscriberCount();;
    $buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";
    $action = "subscribe(\"$userTo\", \"$userLoggedIn\", this)";

    $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

    return "
        <div class='subscribeButtonContainer'>
            $button
        </div>
        ";
 }
}
?>