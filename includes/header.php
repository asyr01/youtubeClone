<?php 

require_once("includes/config.php");
require_once("includes/classes/ButtonProvider.php");
require_once("includes/classes/User.php");
require_once("includes/classes/Video.php");
require_once("includes/classes/VideoGrid.php");
require_once("includes/classes/VideoGridItem.php");
require_once("includes/classes/SubscriptionsProvider.php");
require_once("includes/classes/NavigationMenuProvider.php");

$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>YouTube</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Scripts -->
    <script src="assets/js/commonActions.js"></script>
    <script src="assets/js/userActions.js"></script>
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
        <?php
          echo ButtonProvider::createUserProfileNavigationButton($con, $userLoggedInObj->getUsername());
        ?>
        </div>
      </div>

      <div id="sideNavContainer" style="display:none">
         <?php
          $navigationProvider = new NavigationMenuProvider($con, $userLoggedInObj);
          echo $navigationProvider->create();
         ?>
      </div>

      <div id="mainSectionContainer">
       <div id="mainContentContainer">