<?php
require_once "init.php";

if (!isProfessor() || (isset($_GET["professor"]) && idWithoutDomain($user) != $_GET["professor"])) {
    header("location: index.php");
    exit();
}

$templateParams["title"] = "Aggiorna dettagli account";
$templateParams["content"] = "update_profile_professor_content.php";
$templateParams["style"] = ["style.css"];
$templateParams["js"] = array();

require "template/base.php";
