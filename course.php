<?php
require_once "init.php";

$templateParams["title"] = "Course";
$templateParams["content"] = "course_content.php";
$templateParams["style"] = ["style.css"];
$templateParams["js"] = array("js/tooltip.js", "js/reviews.js");

if (isset($_GET["course"]) && $dbh->courseExists($_GET["course"])) {
    $templateParams["course"] = $_GET["course"];
} else {
    header("location: courses.php");
}

require "template/base.php";
?>