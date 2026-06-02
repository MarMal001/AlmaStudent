<?php
require_once "init.php";

$templateParams["title"] = "Home";
$templateParams["content"] = "home.php";
$templateParams["style"] = ["style.css"];
$templateParams["js"] = array("js/functions.js", "js/toast.js", "js/tooltip.js");

if (isAdmin() && isset($_GET["message"])) {
    $_SESSION["message"] = $_GET["message"];
    
    header("Location: index.php");
    exit();

}

if (isStudent() && $dbh->isStudentBanned($user) && $dbh->studentMustBeDebanned($user)) {
    $dbh->debanStudent($user);
}

require "template/base.php";
?>
