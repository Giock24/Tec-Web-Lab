<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        require_once("./garde_database.php");
        if(!isset($_COOKIE["showTable"])){
            $_COOKIE["showTable"]=0;
        }
        if(!isset($_COOKIE["citizens"])){
            $_COOKIE["citizens"]=[];
        }

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
                $_COOKIE["showTable"] = 0;
                $_COOKIE["citizens"] = "citizen add";
            }
        } else if (isset($_POST["id"])){
            $_COOKIE["showTable"]=1;
            $_COOKIE["citizens"]=$dbh->getCitizen($_POST["id"]);
        } else {
            $_COOKIE["showTable"]=1;
            $_COOKIE["citizens"]=$dbh->getAllCitizen();
        }
    
        var_dump($_COOKIE["citizens"])
    ?>
</head>
<body>
    <form action="#" method="POST">
        <label for="id">id:</label>
        <input id="id" type="number" name="id">
        <label for="data_di_nascita">
        <input id="data_di_nascita" type="date" name="data_di_nascita"> 
        <input type="submit" value="Submit">
    </form>

    <?php if($_COOKIE["showTable"]==1):    ?>
        <table>
            <caption>Cittadini</caption>
            <tr>
                <th id="Nome" scopre="col">Nome</th>
            </tr>
            <?php foreach($_COOKIE["citizens"] as $citizen): ?>
            <tr>
                <td headers="Nome"><?php echo $citizen["nome"]?></td>
            <tr>
        <?php  endforeach; ?>
    <?php endif; ?>
</body>
</html>