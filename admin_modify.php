<?php
require_once "init.php";

$templateParams["title"] = "Create account";
$templateParams["content"] = "admin_modify_content.php";
$templateParams["style"] = ["style.css"];

if (isset($_GET["message"])) {
    $templateParams["message"] = $_GET["message"];
}

require "template/base.php";
?>