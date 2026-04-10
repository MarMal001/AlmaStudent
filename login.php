<?php
require_once "init.php";

$templateParams["title"] = "Login";
$templateParams["content"] = "login_content.php";
$templateParams["style"] = ["style.css", "login.css"];

require "template/base.php";
?>