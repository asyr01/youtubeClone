<?php
class NavigationMenuProvider {
    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
        $menuHtml = $this->createNavItem("Home", 'assets/images/icons/home.png', 'index.php');
        $menuHtml .= $this->createNavItem("Trending", 'assets/images/icons/trending.png', 'trending.php');
        $menuHtml .= $this->createNavItem("Subscriptions", 'assets/images/icons/subscriptions.png', 'subscriptions.php');
        $menuHtml .= $this->createNavItem("Liked Videos", 'assets/images/icons/thumb-up.png', 'likedVideos.php');
    } 

    public function createNavItem($text, $icon, $link) {
        return "
        <div class='navigationItem'>
            <a href='$link'>
                <img src='$icon'>
                <span>$text</span>
            </a>
        </div>
        ";
    }
}
?>