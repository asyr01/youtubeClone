<?php 

class VideoDetailsFormProvider {

    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        return "<form action='processing.php' method='POST'>
                  $fileInput
                  $titleInput
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
}
?>