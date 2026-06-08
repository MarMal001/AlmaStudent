<?php
require_once "init.php";

if (isUserLoggedIn()) {
    header("location: index.php");
    exit();
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $loginResult = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if (count($loginResult) > 0) {
        registerLoggedUser($loginResult[0]);
        header("location: index.php");
    } else {
        $_SESSION["message"] = "Username o password sbagliati";
        $_SESSION["messageType"] = "danger";
        $templateParams["alert"] = "js/alert.js";
    }
}

$templateParams["title"] = "Login";
$templateParams["content"] = "login_content.php";
$templateParams["style"] = ["style.css", "login.css"];

require "template/base.php";
?>
