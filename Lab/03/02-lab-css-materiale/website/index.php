<?php

require_once("bootstrap.php");

$templateParams["titolo"] = "Blog TW - Home";
$templateParams["nome"] = "lista-articoli.php";
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articoli"] = $dbh->getPosts(2);
//base.php sarà un file php con un po' di html, con in mezzo roba di php
//per avere i risultati delle query e metterli nella resa presentazionale
//del html
require("template/base.php");

?>