<?php
  // we have to use session_start() for page to know we are using sessions
  session_start();
  session_destroy();
  header("Location: index.php")
?>