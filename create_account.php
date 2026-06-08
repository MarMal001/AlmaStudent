<?php
require_once "init.php";

if (isUserLoggedIn()) {
    header("location: index.php");
    exit();
}

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["surname"])) {
    $result = $dbh->createAccount($_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"], "STUDENTE");
    if ($result) {
        header("location: login.php");
    } else {
        $_SESSION["message"] = "L'account con questo username esiste già";
        $_SESSION["messageType"] = "danger";
        $templateParams["alert"] = "js/alert.js";
    }
}

$templateParams["title"] = "Create account";
$templateParams["content"] = "create_account_content.php";
$templateParams["style"] = ["style.css", "login.css"];

require "template/base.php";
?>
