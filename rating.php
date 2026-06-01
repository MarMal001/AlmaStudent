<?php
require_once "init.php";

$templateParams["title"] = "Rating";
$templateParams["content"] = "rating_content.php";
$templateParams["style"] = ["style.css"];

if(!isStudent() || !isset($_GET["type"])) {
    header("location: index.php");
} else {
        $dbh = $GLOBALS["dbh"];
        $templateParams["type"] = $_GET["type"];
        if (isset($_GET["course"]) && $dbh->courseExists($_GET["course"])) {
            if ($dbh->canRateCourse($user, $_GET["course"])[0]["existence"]) {
                $templateParams["course"] = $_GET["course"];
            } elseif ($dbh->courseExists($_GET["course"])) {
                header("location: course.php?course=" . $_GET["course"]);
            } else {
                header("location: index.php");
            }
        } else {
            header("location: index.php");
        }
}

require "template/base.php";
?>