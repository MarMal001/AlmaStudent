<?php
require_once "init.php";

if (!isset($_GET["type"])) {
    header("location: index.php");
}

$templateParams["title"] = "Create account";
$templateParams["js"] = array("js/degrees.js");

if ($_GET["type"] == "handleAccount" && isset($_GET["accountType"]) && ($_GET["accountType"] == "ADMIN" || $_GET["accountType"] == "DOCENTE")) {
    array_push($templateParams["js"], "js/accounts.js");
    $templateParams["content"] = "handle_account.php";
} else if ($_GET["type"] == "handleCourse") {
    array_push($templateParams["js"], "js/courses.js");
    $templateParams["degrees"] = $dbh->getDegrees();
    $templateParams["content"] = "handle_course.php";
} else if ($_GET["type"] == "handleDegrees") {
    $templateParams["degrees"] = $dbh->getDegrees();
    $templateParams["content"] = "handle_degrees.php";
} else {
    header("location: index.php");
}

$templateParams["style"] = ["style.css"];

if (isset($_GET["message"])) {
    $templateParams["message"] = $_GET["message"];
}

require "template/base.php";
?>
