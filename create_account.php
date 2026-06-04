<?php
require_once "init.php";

if (isUserLoggedIn()) {
    header("location: index.php");
    exit();
}

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["surname"])) {
    $loginResult = $dbh->createAccount($_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"], "STUDENTE");
    if ($loginResult) {
        header("location: login.php");
    } else {
        $templateParams["toast"] = "js/toast.js";
        $_SESSION["message"] = "L'account con questo username esiste già";
    }
}

$templateParams["title"] = "Create account";
$templateParams["content"] = "create_account_content.php";
$templateParams["style"] = ["style.css", "login.css"];

require "template/base.php";
?>
