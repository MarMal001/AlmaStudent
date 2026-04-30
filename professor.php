<?php
require_once "init.php";

$templateParams["title"] = "Professor";
$templateParams["content"] = "professor_content.php";
$templateParams["style"] = ["style.css"];

if (isset($_GET["professor"])) {
    $templateParams["professor"] = $_GET["professor"];
} else {
    header("location: professors.php");
}

require "template/base.php";
?>