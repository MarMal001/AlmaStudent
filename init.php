<?php
session_start();
define("UPLOAD_DIR", "./images/");
define("SERVER_ROOT", "/AlmaStudent/");

define("RECEPTION_ACTION_ADD", 0);
define("RECEPTION_ACTION_MODIFY", 1);
define("RECEPTION_ACTION_DELETE", 2);

define("ADMIN_ADD_COURSE", 0);
define("ADMIN_ADD_ACCOUNT", 1);
define("ADMIN_ADD_DEGREE", 2);
define("ADMIN_MODIFY_COURSE", 3);
define("ADMIN_MODIFY_ACCOUNT", 4);
define("ADMIN_MODIFY_DEGREE", 5);
define("ADMIN_DELETE_COURSE", 6);
define("ADMIN_DELETE_ACCOUNT", 7);
define("ADMIN_DELETE_DEGREE", 8);

require_once("utils/functions.php");
require_once("db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "AlmaStudent_ER", 3306);

if (!isUserLoggedIn() && $_SERVER['PHP_SELF'] != SERVER_ROOT . "login.php" && $_SERVER['PHP_SELF'] != SERVER_ROOT . "create_account.php") {
    header("location: login.php");
}

if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0777, true);
    chmod(UPLOAD_DIR, 0777);
}

if (isset($_GET["message"])) {
    $_SESSION["message"] = $_GET["message"];
}

if (isUserLoggedIn()) {
    $user = $_SESSION["username"];
    $role = $_SESSION["role"];
}

?>
