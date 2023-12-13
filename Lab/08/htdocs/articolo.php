<?php

require_once("bootstrap.php");

$templateParams["titolo"] = "Blog TW - Home";
$templateParams["nome"] = "singolo-articoli.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();

$idarticolo = -1;
if(isset($_GET["ID"])) {
    // abbiamo recuperato tutti i parametri che si possono raccogliere nella variabile _GET
    $idarticolo = $_GET["id"];
}
$templateParams["articolo"] = $dbh->getPostByID($idarticolo);

require("template/base.php");

?>