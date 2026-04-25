<?php
require_once "init.php";

$templateParams["title"] = "Reception";
$templateParams["content"] = "reception_editable_content.php";
$templateParams["style"] = ["style.css"];

if (isset($_GET["message"])) {
    $templateParams["message"] = $_GET["message"];
}

require "template/base.php";
?>