<?php
require_once "init.php";

if (!isset($_POST["degreeCode"])) {
    $data["message"] = "Corso di laurea invalido";
    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
}

$degreeCode = $_POST["degreeCode"];
$data["professors"] = array();
$professors = $degreeCode == "" ? $dbh->getProfessors() : $dbh->getProfessorsByDegree($degreeCode);
foreach($professors as $professor) {
    $professor["courses"] = $dbh->getCoursesByProfessor($professor["professor"]);
    array_push($data["professors"], $professor);
}

header("Content-Type: application/json");
echo json_encode($data);
