<?php
require_once "init.php";

$templateParams["title"] = "Courses";
$templateParams["content"] = "courses_content.php";
$templateParams["style"] = ["style.css"];
$templateParams["degrees"] = $dbh->getDegrees();
$templateParams["js"] = array();

require "template/base.php";
?>