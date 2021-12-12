<?php
require_once("ProfileData.php");


class ProfileGenerator {

    private $con, $userLoggedInObj, $profileUsername;

    public function __construct($con, $userLoggedInObj, $profileUsername){
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->profileData = new ProfileData($con, $profileUsername);
    }

    public function create() {
        $profileUsername = $this->profileData->getProfileUsername();
        if(!$this->profileData->userExists()){
            return "User does not exist";
        }

        $coverPhotoSection = $this->createCoverPhotoSection();
        $headerSection = $this->createHeaderSection();
        $tabsSection = $this->createTabsSection();
        $contentSection = $this->createContentSection();

        return "<div class='profileContainer'>
                    $coverPhotoSection
                    $headerSection
                    $tabsSection
                    $contentSection
               </div>";
    }

    public function createCoverPhotoSection() {
        $coverPhotoSrc = $this->profileData->getCoverPhoto();
        $name = $this->profileData->getProfileUserFullName();

        return "<div class='coverPhotoContainer'>
                    <span class='channelName'>$name</span>
                    <img src='$coverPhotoSrc' class='coverPhoto'>
                </div>";
    }

    public function createHeaderSection() {
        // creates subscriber button and user info
        $profileImage = $this->profileData->getProfilePic();   
        $name = $this->profileData->getProfileUserFullName();
        $subCount = $this->profileData->getSubscriberCount();

  

        $button = $this->createHeaderButton();

        return "<div class='profileHeader'>
                    <div class='userInfoContainer'>
                        <img src='$profileImage' class='profileImage'>
                        <div class='userInfo'>
                            <span class='title'>$name</span>
                            <span class='subscriberCount'>$subCount subscribers</span>
                        </div>
                    </div>

                    <div class='buttonContainer'>
                     <div class='buttonItem'>
                        $button
                     </div>
                    </div>
                </div>";
    }

    public function createTabsSection() {
        return "
       <ul class='nav nav-tabs' id='myTab' role='tablist'>
         <li class='nav-item' role='presentation'>
          <button class='nav-link active' id='home-tab' data-bs-toggle='tab' data-bs-target='#home' type='button' role='tab' aria-controls='home' aria-selected='true'>Home</button>
         </li>
         <li class='nav-item' role='presentation'>
            <button class='nav-link' id='profile-tab' data-bs-toggle='tab' data-bs-target='#profile' type='button' role='tab' aria-controls='profile' aria-selected='false'>Profile</button>
         </li>
         <li class='nav-item' role='presentation'>
             <button class='nav-link' id='contact-tab' data-bs-toggle='tab'  data-bs-target='#contact' type='button' role='tab' aria-controls='contact' aria-selected='false'>Contact</button>
        </li>
       </ul>
        ";
    }

    public function createContentSection() {
        
    }

    private function createHeaderButton() {
        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUsername()) {
            return "";
        } else {
            return ButtonProvider::createSubscriberButton(
                $this->con,
                $this->profileData->getProfileUserObj(),
                $this->userLoggedInObj,
            );
        }
    }
}  
?>