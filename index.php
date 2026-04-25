<?php
require_once "init.php";

if (!isUserLoggedIn()) {
    header("location: login.php");
}

$templateParams["title"] = "Home";
$templateParams["content"] = "home.php";
$templateParams["style"] = ["style.css"];

require "template/base.php";
?>