<?php
require_once "init.php";

if (isset($_POST["degreeCode"])) {
    $data["courses"] = array();
    $degreeCode = $_POST["degreeCode"];
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
} else {
    $data["message"] = "Cannot get courses of this degree";
}

header("Content-Type: application/json");
echo json_encode($data);
?>
