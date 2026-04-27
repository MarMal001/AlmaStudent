<?php
require_once "init.php";

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["studentId"])) {
    $loginResult = $dbh->createAccout($_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"], "STUDENTE", $_POST["studentId"]);
    echo $loginResult;
    if ($loginResult) {
        registerLoggedUser($loginResult[0]);
        header("location: index.php");
    } else {
        $templateParams["createAccountError"] = "Account already exists";
    }
}

$templateParams["title"] = "Create account";
$templateParams["content"] = "create_account_content.php";
$templateParams["style"] = ["style.css", "login.css"];

require "template/base.php";
?>