<?php
require_once "init.php";

$templateParams["title"] = "Home";
$templateParams["content"] = "home.php";
$templateParams["style"] = ["style.css"];
$templateParams["js"] = array();

if (isAdmin() && isset($_GET["message"])) {
    $_SESSION["message"] = $_GET["message"];
    
    header("Location: index.php");
    exit();

}

require "template/base.php";
?>