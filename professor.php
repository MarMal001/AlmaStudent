<?php
require_once "init.php";

$templateParams["title"] = "Professor";
$templateParams["content"] = "professor_content.php";
$templateParams["style"] = ["style.css"];

if (isset($_GET["professor"])) {
    $templateParams["professor"] = $_GET["professor"];
};

require "template/base.php";
?>