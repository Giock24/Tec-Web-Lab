<?php
    require_once("./garde_database.php");

    if(
        isset($_POST["nome"]) &&
        isset($_POST["cognome"]) &&
        isset($_POST["codice_fiscale"]) &&
        isset($_POST["data_di_nascita"]) &&
        isset($_POST["sesso"])
    ){
        $_COOKIE["showTable"]=0;
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $codice_fiscale = $_POST["codice_fiscale"];
        $data_di_nascita = $_POST["data_di_nascita"];
        $sesso = $_POST["sesso"];
        if(
            gettype($nome) == "string" &&
            gettype($cognome) == "string" &&
            gettype($codice_fiscale) == "string" &&
            strlen($codice_fiscale) == 16 &&
            ($sesso=="M" || $sesso=="S" || $sesso=="A")
        ){
            $dbh->addCitizen($nome,$cognome,$codice_fiscale,$data_di_nascita,$sesso);
            $_COOKIE["showTable"]=0
            $_COOKIE["ci"] "citizen add";
        }
    } else if (isset($_POST["id"])){
        $_COOKIE["showTable"]=1;
        $result=$dbh->getCitizen($_POST["id"]);
    } else {
        $_COOKIE["showTable"]=1;
        $result=$dbh->getAllCitizen();
    }

    //header("Location garde_page.php");
?>