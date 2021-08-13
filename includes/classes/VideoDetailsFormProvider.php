<?php 

class VideoDetailsFormProvider {

    private $con;
    public function __construct($con) {
      $this->con = $con;
    }

    public function createUploadForm() {

        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privacyInput = $this->createPrivacyInput();
        $categoriesInput = $this->createCategoriesInput();


        return "<form action='processing.php' method='POST'>
                  $fileInput
                  $titleInput
                  $descriptionInput
                  $privacyInput
                  $categoriesInput
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

    private function createPrivacyInput() {
      return 
      "<div class='form-group'>
      <select class='form-select' name='privacyInput'>
            <option value='0'>Private</option>
            <option value='1'>Public</option>
      </select>
   </div>";
    }

    private function createCategoriesInput() {
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
}
?>