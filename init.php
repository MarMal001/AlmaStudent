<?php
session_start();
define("UPLOAD_DIR", "./images/");

define("RECEPTION_ACTION_ADD", 0);
define("RECEPTION_ACTION_MODIFY", 1);
define("RECEPTION_ACTION_DELETE", 2);

require_once("utils/functions.php");
require_once("db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "AlmaStudent_ER", 3306);
?>