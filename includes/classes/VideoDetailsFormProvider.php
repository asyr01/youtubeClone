<?php 

class VideoDetailsFormProvider {

    private $con;
    public function __construct($con) {
      $this->con = $con;
    }

    public function createUploadForm() {
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput(null);
        $descriptionInput = $this->createDescriptionInput(null);
        $privacyInput = $this->createPrivacyInput(null);
        $categoriesInput = $this->createCategoriesInput(null);
        $uploadButton = $this->createUploadButton();


        return "<form action='processing.php' method='POST' enctype='multipart/form-data'> 
                  $fileInput
                  $titleInput
                  $descriptionInput
                  $privacyInput
                  $categoriesInput
                  $uploadButton
               </form>
        ";
    }

    public function createEditDetailsForm($video) {
      $titleInput = $this->createTitleInput($video->getTitle());
      $descriptionInput = $this->createDescriptionInput($video->getDescription());
      $privacyInput = $this->createPrivacyInput($video->getPrivacy());
      $categoriesInput = $this->createCategoriesInput($video->getCategory());
      $saveButton = $this->createSaveButton();


      return "<form method='POST'> 
                $titleInput
                $descriptionInput
                $privacyInput
                $categoriesInput
                $saveButton
             </form>
      ";
  }

    private function createFileInput() {
    return "<div class='form-group'>
          <label for='formControlFile1'>Your File</label>
          <input type='file' class='form-control-file' name='fileInput'id='formControlFile1' required>
       </div>";
  }

  private function createTitleInput($value) {
    if($value == null) $value="";
  return "<div class='form-group'>
            <input class='form-control' type='text' placeholder='Title' name='titleInput' aria-label='default input example' value='$value'>
        </div>";
  }

  private function createDescriptionInput($value) {
    if($value == null) $value="";
    return "<div class='form-group'>
          <textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3'></textarea> value='$value'
        </div>";
    }

    private function createPrivacyInput($value) {
      if($value == null) $value="";
      return 
      "<div class='form-group'>
      <select class='form-select' name='privacyInput'>
            <option value='0'>Private</option>
            <option value='1'>Public</option>
      </select>
   </div>";
    }

    private function createCategoriesInput($value) {
    // Retrieve data from categories table
    $query = $this->con->prepare("SELECT * FROM categories");
    $query->execute();

    $html = "<div class='form-group'>
    <select class='form-select' name='categoryInput'>";

    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $name = $row["name"];
      $id = $row["id"];
      $html .= " <option value='$id'>$name</option>";
    }
    $html .= "</select>
        </div>";
        return $html;
  }

  private function createUploadButton() {
    return "
    <div class='col text-center'>
      <button type='submit' class='btn btn-primary' name='uploadBtn'>Upload</button>
    </div>";
  }

  private function createSaveButton() {
    return "
    <div class='col text-center'>
      <button type='submit' class='btn btn-primary' name='saveBtn'>Save</button>
    </div>";
  }
}
?>