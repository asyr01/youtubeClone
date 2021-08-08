<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>YouTube</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  </head>
  <body>
    <div id="pageContainer">
      <div id="mastHeadContainer">
        <button class="navShowHide">
          <img src="assets/images/icons/menu.png" alt="menu button">
        </button>

        <a href="index.php" class="logoContainer">
        <img src="assets/images/icons/youtube.png" alt="youtube logo" title="YouTube Homepage">
        </a>

        <div class="searchBarContainer">
          <form action="search.php" method="GET">
            <input type="text" class="searchBar" name="term" placeholder="Search...">
            <button class="searchButton">
            <img src="assets/images/icons/search.png" alt="search button">
            </button>
          </form>
        </div>

        <div class="rightIcons">
        <a href="upload.php">
          <img class="upload" src="assets/images/icons/upload.png" alt="upload button">
        </a>
        <!-- There is no link for now because there is a authorization issue -->
        <a href="#">
          <img class="profile" src="assets/images/profilePictures/default.png" alt="profile button">
        </a>
      </div>
      </div>

      <div id="sideNavContainer" style="display:none">
         
      </div>

      <div id="mainSectionContainer">
       <div id="mainContentContainer">