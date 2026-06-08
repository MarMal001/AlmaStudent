<?php
require_once "init.php";

$templateParams["title"] = "Professor";
$templateParams["content"] = "professor_content.php";
$templateParams["style"] = ["style.css", "professor.css"];
$templateParams["js"] = array("js/tooltip.js", "js/reception.js", "js/reviews.js");

if (isset($_GET["professor"]) && $dbh->professorExists($_GET["professor"] . "@unibo.it")) {
    $templateParams["professor"] = $_GET["professor"] . "@unibo.it";
} else {
    header("location: professors.php");
}

require "template/base.php";
?>