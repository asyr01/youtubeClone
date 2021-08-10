<?php 

class VideoDetailsFormProvider {

    public function createUploadForm() {

        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();


        return "<form action='processing.php' method='POST'>
                  $fileInput
                  $titleInput
                  $descriptionInput
               </form>
        ";
    }

    private function createFileInput() {
    return "<div class='form-group'>
      <label for='formControlFile1'>Your File</label>
      <input type='file' class='form-control-file' name='fileInput'id='formControlFile1' required>
    </div>";
  }

  private function createTitleInput() {
  return "<div class='form-group'>
  <input class='form-control' type='text' placeholder='Title' name='titleInput' aria-label='default input example'>
  </div>";
  }

  private function createDescriptionInput() {
    return "<div class='form-group'>
    <textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3'></textarea>
  </div>";
    }
}

?>