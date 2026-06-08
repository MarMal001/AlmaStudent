<?php
require_once "init.php";

if (!isset($_POST["degreeCode"]) || !isset($_POST["type"])) {
    $data["message"] = "Corso di laurea invalido";
    $data["messageType"] = "warning";
    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
}

$degreeCode = $_POST["degreeCode"];
if ($_POST["type"] == "courses") {
    $data["degrees"] = $dbh->getDegrees();
    $data["isStudent"] = isStudent();
    $data["user"] = $user;
    if ($degreeCode == "") {
        $courses = $dbh->getCourses();
        $data["courses"] = array();
        foreach ($courses as $course) {
            $course["professors"] = array();
            $course["isSubscribed"] = $dbh->checkIfSubscribedToACourse($user, $course["code"]);
            foreach ($dbh->getProfessorsByCourse($course["code"]) as $professor) {
                array_push($course["professors"], $professor);
            }
            array_push($data["courses"], $course);
        }
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }

    $data["courses"] = array();
    $degreeYears = $dbh->getYearsDegree($degreeCode);
    for ($year = 1; $year <= $degreeYears; $year++) {
        $courses = $dbh->getCoursesByDegreeAndYear($degreeCode, $year);
        $data["courses"][$year] = array();
        foreach ($courses as $course) {
            $course["professors"] = array();
            $course["isSubscribed"] = $dbh->checkIfSubscribedToACourse($user, $course["code"]);
            foreach ($dbh->getProfessorsByCourse($course["code"]) as $professor) {
                array_push($course["professors"], $professor);
            }
            array_push($data["courses"][$year], $course);
        }
    }
    $data["degreeYears"] = $degreeYears;
    $data["professors"] = $dbh->getProfessors();
} else if ($_POST["type"] == "updateDegree") {
    $data["degree"] = $dbh->getDegreeByCode($_POST["degreeCode"]);
} else {
    $data["message"] = "Tipo non riconosciuto";
    $data["messageType"] = "warning";
}

header("Content-Type: application/json");
echo json_encode($data);
