<?php
require_once "init.php";

if (!isset($_GET["type"])) {
    header("location: index.php");
}

$templateParams["title"] = "Create account";

if ($_GET["type"] == "addAccount") {
    $templateParams["content"] = "add_account.php";
} else if ($_GET["type"] == "addCourse") {
    $templateParams["degrees"] = $dbh->getDegrees();
    $templateParams["content"] = "add_course.php";
} else if ($_GET["type"] == "handleDegrees") {
    $templateParams["degrees"] = $dbh->getDegrees();
    $templateParams["content"] = "handle_degrees.php";
}

$templateParams["style"] = ["style.css"];
$templateParams["js"] = array("js/degrees.js");

if (isset($_GET["message"])) {
    $templateParams["message"] = $_GET["message"];
}

require "template/base.php";
?>
