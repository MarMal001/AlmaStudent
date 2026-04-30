<?php
session_start();
define("UPLOAD_DIR", "./images/");
define("SERVER_ROOT", "/AlmaStudent/");

define("RECEPTION_ACTION_ADD", 0);
define("RECEPTION_ACTION_MODIFY", 1);
define("RECEPTION_ACTION_DELETE", 2);

require_once("utils/functions.php");
require_once("db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "AlmaStudent_ER", 3306);

if (!isUserLoggedIn() && $_SERVER['PHP_SELF'] != SERVER_ROOT . "login.php" && $_SERVER['PHP_SELF'] != SERVER_ROOT . "create_account.php") {
    header("location: login.php");
}

if (isUserLoggedIn()) {
    $user = $_SESSION["username"];
    $role = $_SESSION["role"];
}

?>