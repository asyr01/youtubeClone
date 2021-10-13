<?php
 if(isset($_POST['userTo']) && isset($_POST['userFrom'])) {
    echo "succeded";
 } else {
     echo "One or more parameters are not passed into subscribe.php the file";
 }
?>