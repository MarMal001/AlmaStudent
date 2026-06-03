<?php
require_once "init.php";

$data["reservations"] = array();

foreach ($dbh->getReservationsOfProfessor($_POST["professor"], $_POST["date"]) as $reservation) {
    $reservation["timeRange"] = date("H:i", strtotime($reservation["startTime"])) . " - " . date("H:i", strtotime($reservation["endTime"]));
    array_push($data["reservations"], $reservation);
}

$data["user"] = $user;
$data["isStudent"] = isStudent();
$data["POST"] = $_POST;

header("Content-Type: application/json");
echo json_encode($data);