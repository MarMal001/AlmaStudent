<?php
require_once "init.php";

$templateParams["title"] = "Professors";
$templateParams["content"] = "professors_content.php";
$templateParams["style"] = ["style.css"];
$templateParams["degrees"] = $dbh->getDegrees();
$templateParams["js"] = array();

require "template/base.php";
?>