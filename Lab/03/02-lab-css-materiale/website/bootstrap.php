<?php
require_once("db/database.php"); //definisco che database prendere
//variabili iniziano con $
$dbh = new DatabaseHelper("localhost", "root", "", "blogtw", 3306);
// UPLOAD_DIR cartella in cui vengono messi tutti i file da caricare
define("UPLOAD_DIR", "./upload/");
?>