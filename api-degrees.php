<?php
require_once "init.php";

if (isset($_POST["degreeCode"]) && isset($_POST["type"])) {
    $degreeCode = $_POST["degreeCode"];
    if ($_POST["type"] == "courses") {
        $data["courses"] = array();
        $degreeYears = $dbh->getYearsDegree($degreeCode);
        for ($year = 1; $year <= $degreeYears; $year++) {
            $courses = $dbh->getCoursesByDegreeAndYear($degreeCode, $year);
            $data["courses"][$year] = array();
            foreach ($courses as $course) {
                $course["professors"] = array();
                $course["isSubscribed"] = $dbh->checkIfSubscribedToACourse($user, $course["code"])[0]["subscribed"];
                foreach ($dbh->getProfessorsByCourse($course["code"]) as $professor) {
                    array_push($course["professors"], $professor);
                }
                array_push($data["courses"][$year], $course);
            }
        }
        $data["isStudent"] = isStudent();
        $data["degreeYears"] = $degreeYears;
        $data["user"] = $user;
    } else if ($_POST["type"] == "professors") {
        $data["professors"] = array();
        $professors = $dbh->getProfessorsByDegree($degreeCode);
        foreach($professors as $professor) {
            $professor["courses"] = $dbh->getCoursesByProfessor($professor["professor"]);
            array_push($data["professors"], $professor);
        }
    } else {
        $data["message"] = "Tipo non riconosciuto";
    }
} else {
    $data["message"] = "Corso di laurea invalido";
}

header("Content-Type: application/json");
echo json_encode($data);
