<?php

function getIDFromName($name){
    // preg_replace, searches subject for matches to pattern and replaces them with replacement
    return preg_replace("/[^a-z]/", '', strtolower($name));
}

function isUserLoggedIn() {
    return !empty($_SESSION["idautore"]);
}

?>