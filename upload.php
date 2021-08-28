<?php
   require_once("includes/header.php");
   require_once("includes/classes/VideoDetailsFormProvider.php");
?>

<div class="column">
      <?php 
        $formProvider = new VideoDetailsFormProvider($con);
        echo $formProvider->createUploadForm();
      ?>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Please wait. This might take a while.
      </div>
    </div>
  </div>
</div>

<?php require_once("includes/footer.php");?>