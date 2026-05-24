<?php
require_once "init.php";

$templateParams["title"] = "Report";
$templateParams["content"] = "report_handling_content.php";
$templateParams["style"] = ["style.css"];

// if (isset($_GET["course"])) {
//     $templateParams["course"] = $_GET["course"];
// } else {
//     header("location: courses.php");
// }

require "template/base.php";
?>