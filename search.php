<?php
require_once("includes/header.php");
require_once("includes/classes/SearchResultsProvider.php");

if(!isset($_GET["term"]) || $_GET["term"] == "") {
  echo "You must enter a search term";
  exit();
}

$term = $_GET["term"];

if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == "views") {
    $orderBy = "views";
} else {
    $orderBy = "uploadDate";
}

$searchResultsProvider = new SearchResultsProvider($con, $userLoggedInObj);
$videos = $searchResultsProvider->getVideos($term, $orderBy);
?>



<?php
require_once("includes/footer.php");
?>