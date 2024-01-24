<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome"><br>
        <label for="cognome">Cognome:</label><br>
        <input type="text" id="cognome" name="cognome"><br>
        <label for="CF">Codice Fiscale:</label><br>
        <input type="text" id="CF" name="CF"><br>
        <label for="data-nascita">Data di nascita:</label><br>
        <input type="text" id="data-nascita" name="data-nascita"><br>
        <label for="sesso">Sesso:</label><br>
        <input type="text" id="sesso" name="sesso"><br>
        <input type="submit" value="Invia">
    </form>
</body>
</html>

<?php

    if ( isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["CF"])
     && isset($_POST["data-nascita"]) && isset($_POST["sesso"]) ) {
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $cf = $_POST["CF"];
        $data = $_POST["data-nascita"];
        $sesso = $_POST["sesso"];

        $namedb = "db_esami";

        // get type è una funzione che ritorna il tipo di dato
        // della variabile, valori di ritorno:
        /*
            "boolean"
            "integer"
            "double" (for historical reasons "double" is returned in case of a float, and not simply "float")
            "string"
            "array"
            "object"
            "resource"
            "resource (closed)" as of PHP 7.2.0
            "NULL"
            "unknown type"
        */

        // is_numeric è una funzione che permette di capire se la variabile che hai
        // passato è un numero oppure no, ritorna o true o false
        if (!is_numeric($nome) && !is_numeric($cognome)) {

            if (strlen($cf) == 16) {

                if (check_date($data) && check_sex($sesso)) {
                    // Create connection
                    $conn = new mysqli("localhost", "root", "", $namedb);
                    // Check connection
                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    } else {
                        //echo "Connected successfully";
                        $query = "INSERT INTO cittadino (idcittadino, nome, cognome, codicefiscale, datanascita, sesso)
                        VALUES (?,?,?,?,?,?)";
                    }
                }

            } else {
                echo "Inserisci un CF lungo 16 caratteri / cifre";
            }

        } else {
            echo "Il nome o cognome devono essere stringhe";
        }

    } else {
        echo "Qualcosa non è stato settato";
    }

    // questa funziona controlla se hai scritto correttamente la data (FORMATO DATA -> YYYY-MM-DD)
    function check_date($date) {
        $array_value = explode("-", $date);
        //var_dump($array_value);
        if (count($array_value) != 3) {
            echo "Data NON Valida!!!";
            return false;
        } else {
            //echo "entro primo IF";
            //var_dump(strlen($array_value[0]));
            if (strlen($array_value[0]) == 4 && strlen($array_value[1])  == 2 && strlen($array_value[2])  == 2) {
                echo "Data Valida!";
                return true;
            } else {
                echo "Data NON Valida!!!";
                return false;
            }
        }

    }

    // controlla che tu abbiam messo una di queste lettere per il sesso
    function check_sex($sesso) {
        if ($sesso == "M" || $sesso == "F" || $sesso == "A") {
            return true;
        } else {
            echo "Non esiste quel tipo di sesso: metti M, F o A";
            return false;
        }
    }
?>

