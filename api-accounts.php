<?php
require_once "init.php";

if (isset($_POST["code"]) && isset($_POST["type"])) {
    $code = $_POST["code"];
    if ($_POST["type"] == "professor") {
        $data["professor"] = $dbh->getProfessorInfo($code)[0];
        $data["photo"] = UPLOAD_DIR . "/professor/" . $data["professor"]["photo"];
    } else if ($_POST["type"] == "admin") {
        $data["admin"] = $dbh->getPersonInfo($code)[0];
    } else {
        $data["message"] = "Tipologia di account invalida";
        $data["messageType"] = "warning";
    }
} else {
    $data["message"] = "Professore non trovato";
    $data["messageType"] = "danger";
}

header("Content-Type: application/json");
echo json_encode($data);
