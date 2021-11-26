<?php
class NavigationMenuProvider {
    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){

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