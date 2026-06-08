<?php

require_once "init.php";

$data["reviews"] = array();

if ($_POST["type"] == "course") {
    if($_POST["limit"] == "") {
        $reviews = $dbh->getReviewsByCourse($_POST["course"]);
    } else {
        $reviews = $dbh->getLimitedNumberCourseReviews($_POST["course"], $_POST["limit"]);
    }
    foreach ($reviews as $review) {
        $review["text"] = htmlspecialchars($review["text"]);
        $review["date"] = date("d/m/Y", strtotime($review["date"]));
        $ratings = $dbh->getCourseRatingbyStudent($_POST["course"], $review["student"])[0];
        $review["ratings"] = array($ratings["rating_L"], $ratings["rating_M"], $ratings["rating_E"]);
        $review["studentInfo"] = $dbh->getPersonInfo($review["student"])[0];
        array_push($data["reviews"], $review);
    }
} else {
    if($_POST["limit"] == "") {
        $reviews = $dbh->getReviewsByProfessor($_POST["professor"]);
    } else {
        $reviews = $dbh->getLimitedNumberProfessorReviews($_POST["professor"], $_POST["limit"]);
    }
    foreach ($reviews as $review) {
        $review["text"] = htmlspecialchars($review["text"]);
        $review["date"] = date("d/m/Y", strtotime($review["date"]));
        $ratings = $dbh->getProfessorRatingbyStudent($_POST["professor"], $review["student"])[0];
        $review["ratings"] = array($ratings["rating_D"], $ratings["rating_C"], $ratings["rating_I"]);
        $review["studentInfo"] = $dbh->getPersonInfo($review["student"])[0];
        $review["courseName"] = $dbh->getCourseInfo($review["course"])[0]["name"];
        array_push($data["reviews"], $review);
    }
}

$data["user"] = $user;

header("Content-Type: application/json");
echo json_encode($data);

