<?php
session_start();
define("UPLOAD_DIR", "./images/");
require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "AlmaStudent_ER", 3306);
?>