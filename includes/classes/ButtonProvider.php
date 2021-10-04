 <!-- Creates a buton with passed parameters -->
<?php

class ButtonProvider {

public static $signInFunction = "notSignedIn()";

public static function createLink($link) {
    return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
}

public static function createButton($text, $imageSrc, $action, $class ) {
        // Checks if image source passed
        $image = ($imageSrc == null) ? "": "<img src='$imageSrc'>";

        // Change action if needed if they are not logged in redirect them
        

        return "<button class='$class' onclick='$action'>
         $image
         <span class='text'>$text</span>
        </button>";
    }
}

?>