<?php
require_once "init.php";

$templateParams["title"] = "Edit Course";
$templateParams["content"] = "course_editable_content.php";
$templateParams["style"] = ["style.css"];

if (isset($_GET["course"])) {
    $templateParams["course"] = $_GET["course"];
    if (!isDesignatedProfessor($user, $templateParams["course"])) {
        header("location: courses.php");
    }
} else {
    header("location: courses.php");
}

require "template/base.php";
?>