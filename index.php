<?php
require_once "init.php";

$templateParams["title"] = "Home";
$templateParams["content"] = "home.php";
$templateParams["style"] = ["style.css"];
$templateParams["js"] = array("js/functions.js", "js/tooltip.js", "js/calendar.js");

if (isStudent() && $dbh->isStudentBanned($user) && $dbh->studentMustBeDebanned($user)) {
    $dbh->debanStudent($user);
}

require "template/base.php";
?>
