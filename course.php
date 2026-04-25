<?php
require_once "init.php";

$templateParams["title"] = "Course";
$templateParams["content"] = "course_content.php";
$templateParams["style"] = ["style.css"];

if (isset($_GET["course"])) {
    $templateParams["course"] = $_GET["course"];
};

require "template/base.php";
?>