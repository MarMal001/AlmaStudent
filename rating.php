<?php
require_once "init.php";

$templateParams["title"] = "Rating";
$templateParams["content"] = "rating_content.php";
$templateParams["style"] = ["style.css"];
$templateParams["type"] = $_GET["type"];

//TODO --> add checks to see if it's a student tahat can rate (innest in an if else)

if (isset($_GET["professor"])) {
    $templateParams["professor"] = $_GET["professor"] . "@unibo.it";
} else if (isset($_GET["course"])) {
    $templateParams["course"] = $_GET["course"];
} else {
    //TODO --> handle redirectioning
}

require "template/base.php";
?>