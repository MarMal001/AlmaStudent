<?php
require_once "init.php";

$templateParams["title"] = "Rating";
$templateParams["content"] = "rating_content.php";
$templateParams["style"] = ["style.css"];
$templateParams["type"] = $_GET["type"];

if (isset($_GET["professor"])) {
    $templateParams["professor"] = $_GET["professor"] . "@unibo.it";
} 
if (isset($_GET["course"])) {
    $templateParams["course"] = $_GET["course"];
}

require "template/base.php";
?>