<?php
   require_once("includes/header.php");
   require_once("includes/classes/VideoDetailsFormProvider.php");
?>

<div class="column">
      <?php 
        $formProvider = new VideoDetailsFormProvider();
        echo $formProvider->createUploadForm();

        // Retrieve data from categories table
        $query = $con->prepare("SELECT * FROM categories");
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
          echo $row["name"] . "<br>";
        }
      ?>
</div>

<?php require_once("includes/footer.php");?>