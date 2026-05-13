<?php

require_once "init.php";

if (!isAdmin()) {
    header("location: login.php");
}

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["type"])) {
    if ($_POST["type"] == "admin" || $_POST["type"] == "professor") {
        if (isset($_POST["department"]) && isset($_POST["seat"]) && isset($_POST["infoReception"])) {
            $department = $_POST["department"];
            $seat = $_POST["seat"];
            $infoReception = $_POST["infoReception"];

            if (isset($_FILES["profilePicture"])) {
                $profilePicture = UPLOAD_DIR . "professor/" . $_POST["username"] . ".png";
                $f = fopen($profilePicture, "wb");
                fwrite($f, file_get_contents($_FILES["profilePicture"]["tmp_name"]));
            } else {
                $profilePicture = "default.png";
            }
        } else {
            $department = NULL;
            $seat = NULL;
            $infoReception = NULL;
            $profilePicture = NULL;
        }

        if ($dbh->createAccout($_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["type"], department: $department, seat: $seat, infoReception: $infoReception, profilePicture: $profilePicture)) {
            $message = "Account aggiunto con successo";
        } else {
            $message = "Non è stato possibile aggiungere l'account";
        }
    } else {
        $message = "Azione sconosciuta: " . $_POST["action"];
    }
}

header("location: admin_modify.php?message=" . $GLOBALS["message"]);

?>