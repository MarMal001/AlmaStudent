<?php
require_once "init.php";

define("ADD_COURSE", 0);
define("ADD_ACCOUNT", 1);

if (!isset($_GET["type"])) {
    header("location: index.php");
}

$templateParams["title"] = "Create account";

if ($_GET["type"] == "addAccount") {
    $templateParams["content"] = "add_account.php";
} else if ($_GET["type"] == "addCourse") {
    $templateParams["degrees"] = $dbh->getDegrees();
    $templateParams["content"] = "add_course.php";
}

$templateParams["style"] = ["style.css"];

if (isset($_GET["message"])) {
    $templateParams["message"] = $_GET["message"];
}

require "template/base.php";
?>