<?php

require_once "init.php";

if ($_GET["type"] == "remove") {
    $state = $dbh->removeReportedReview($_GET["id"], $_GET["student"]);
} else if ($_GET["type"] == "annul") {
    $state = $dbh->annulReport($_GET["id"]);  
} else if ($_GET["type"] == "add") {
    $state = $dbh->addReportToAReview($_GET["id"]);
    header("location: " . $_GET["page"]);
    return;
}
if ($state) {
    $message = "Operazione avvenuta correttamente";
} else {
    $message = "Non è stato possibile svolgere l'operazione";
}

header("location: index.php?message=$message");