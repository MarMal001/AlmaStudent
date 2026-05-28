<?php
require_once "init.php";

$templateParams["title"] = "Report";
$templateParams["content"] = "report_handling_content.php";
$templateParams["style"] = ["style.css"];

if (isset($_GET["id"]) && isset($_GET["type"]) && isAdmin()) {
   $templateParams["id"] = $_GET["id"];
   $templateParams["type"] = $_GET["type"];
} else {
   header("location: index.php");
}

require "template/base.php";
?>