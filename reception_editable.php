<?php
require_once "init.php";

if (!isProfessor()) {
    header("location: index.php");
    exit();
}

$templateParams["title"] = "Reception";
$templateParams["content"] = "reception_editable_content.php";
$templateParams["style"] = ["style.css"];
$templateParams["js"] = array("js/reception.js", "js/tooltip.js");

if (isset($_GET["message"])) {
    $templateParams["message"] = $_GET["message"];
}

require "template/base.php";
?>
