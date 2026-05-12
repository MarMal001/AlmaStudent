<?php

require_once "init.php";

if (!isAdmin()) {
    header("location: login.php");
}

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["type"])) {
    if ($_POST["type"] == "admin" || $_POST["type"] == "professor") {
        if ($dbh->createAccout($_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["type"])) {
            $GLOBALS["message"] = "Account aggiunto con successo";
        } else {
            $GLOBALS["message"] = "Non è stato possibile aggiungere l'account";
        }
    } else {
        $GLOBALS["message"] = "Azione sconosciuta: " . $_POST["action"];
    }
}

header("location: admin_modify.php?message=" . $GLOBALS["message"]);

?>