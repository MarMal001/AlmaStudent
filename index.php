<?php
require_once "init.php";

$templateParams["title"] = "Home";
$templateParams["content"] = "home.php";
$templateParams["style"] = ["style.css"];
$templateParams["js"] = array("js/functions.js", "js/tooltip.js");

if (isset($_SESSION["message"])) {
    array_push($templateParams["js"], ("js/toast.js"));
}

if (isStudent() && $dbh->isStudentBanned($user) && $dbh->studentMustBeDebanned($user)) {
    $dbh->debanStudent($user);
}

require "template/base.php";
?>
