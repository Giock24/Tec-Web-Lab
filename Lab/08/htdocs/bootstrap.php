<?php
require_once("db/database.php"); //definisco che database prendere
require_once("utils/functions.php");
//variabili iniziano con $, questo in PHP
$dbh = new DatabaseHelper("localhost", "root", "", "blogtw", 3306);
// UPLOAD_DIR cartella in cui vengono messi tutti i file da caricare (nel nostro caso sono immagini)
define("UPLOAD_DIR", "./upload/");
?>