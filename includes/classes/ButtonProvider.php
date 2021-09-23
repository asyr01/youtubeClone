 <!-- Creates a buton with passed parameters -->
<?php

class ButtonProvider {

public static function createButton($text, $imageSrc, $action, $class ) {
        // Checks if image source passed
        $image = ($imageSrc == null) ? "": "<img src='$imageSrc'>";
        return "<button class='$class' onclick='$action'>
         <span class='text'>$text</span>
        </button>";
    }
}

?>