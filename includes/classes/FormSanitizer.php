<?php

class FormSanitizer {

// Sanitizing form data -trim the spaces etc, prevent html tags to prevent sql/script injection etc, capitalize first letter-

public static function sanitizeFormString($inputText) {
    // prevents tag injection
    $inputText = strip_tags($inputText);
    // remove blank spaces
    $inputText = str_replace(" ", "", $inputText);
    // make string lowercase
    $inputText = strtolower($inputText);
    // capitalize first letter
    $inputText = ucfirst($inputText);
    return $inputText;
  }

public static function sanitizeFormUsername($inputText) {
    // prevents tag injection
    $inputText = strip_tags($inputText);
    // remove blank spaces
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
  }

  public static function sanitizeFormPassword($inputText) {
    // prevents tag injection
    $inputText = strip_tags($inputText);
    return $inputText;
  }

  public static function sanitizeFormEmail($inputText) {
    // prevents tag injection
    $inputText = strip_tags($inputText);
    // remove blank spaces
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
  }
}
?>


