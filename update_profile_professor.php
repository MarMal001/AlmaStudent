<?php
require_once "init.php";

if (idWithoutDomain($user) != $_GET["professor"]) {
    header("location: index.php");
}

$templateParams["title"] = "Aggiorna dettagli account";
$templateParams["content"] = "update_profile_professor_content.php";
$templateParams["style"] = ["style.css"];
$templateParams["js"] = array();

if (isset($_GET["message"])) {
    $templateParams["message"] = $_GET["message"];
}

require "template/base.php";
