<?php
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoDetailsFormProvider.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/SelectThumbnail.php");

// Checks if user logged im
if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

// Checks if there is videoId parameter at the url bar.
if(!isset($_GET["videoId"])) {
    echo "No video selected";
    exit();
}

$video = new Video($con,$_GET["videoId"],$userLoggedInObj);
if($video->getUploadedBy() != $userLoggedInObj->getUsername()) {
    echo "You are not allowed to perform this action";
    exit();
}

if(isset($_POST["saveButton"])) {
    $videoData = new VideoUpdateData(
        null,
        $_POST["titleInput"],
        $_POST["descriptionInput"],
        $_POST["privacyInput"],
        $_POST["categoryInput"],
        $userLoggedInObj->getUsername(),
    );

    if($videoData->updateDetails($con, $videoId)) {
        // succesfully updated
        $detailsMessage = "
            <div class='alert alert-success'>
                <b>User details succesfully updated.</b>
            </div>
        ";
    } else {
        $detailsMessage = "
            <div class='alert alert-danger'>
                <strong>ERROR!</strong> Something went wrong.
            </div>
        ";
    }
    
}
?>

<script src='assets/js/editVideoActions.js'></script>

<div class = 'editVideoContainer column'>
    <div class='topSection'>
        <?php
            $videoPlayer = new VideoPlayer($video);
            echo $videoPlayer->create(false);

            $selectThumbnail = new SelectThumbnail($con, $video);
            echo $selectThumbnail->create();
        ?>
    </div>

    <div class='bottomSection'>
        <?php
            $formProvider = new VideoDetailsFormProvider($con);
            echo $formProvider->createEditDetailsForm($video);
        ?>
    </div>

</div>