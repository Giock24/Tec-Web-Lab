<form action="#" method="GET">
    <h2>Esercizio PHP</h2>
    <ul>
        <li>
            <label for="letter-a">A:</label><input type="text" id="letter-a" name="letter-a" />
        </li>
        <li>
            <label for="letter-b">B:</label><input type="text" id="letter-b" name="letter-b" />
        </li>
        <li>
            <label for="letter-c">C:</label><input type="text" id="letter-c" name="letter-c" />
        </li>
        <li>
            <input type="submit" name="submit" value="Invia" />
        </li>
    </ul>
</form>

<?php

    $namedb = "giugno";
    $nametable = "insiemi";
    $username = "root";
    $pw = "";
    $db = new mysqli("localhost" , $username, $pw);

    if ($db->connect_error) {
        // The die() function in PHP is used to print 
        //a message and terminate the current script execution.
        die("Connection Failed: " . $db->connect_error);
    } else {
        echo "Connection Success \n";
        echo $_GET['letter-a'];

        $A = transformToInt($_GET['letter-a']);
        $B = transformToInt($_GET['letter-b']);
        $C = transformToInt($_GET['letter-c']);
        //$letters = array($A, $B, $C);

        // Controllo che le variabili passate siano NON nulle
        // e maggiori di zero
        if ($A > 0 && $B > 0 && $C > 0) {
            $exist = "SELECT COUNT(valore) FROM insiemi WHERE valore=?"
            
            $stmt = $db->prepare($exist);
            $stmt->bind_param('i', $A);
            $stmt->execute();
            $result = $stmt->get_result();

            echo $result;
        }

    }

    function transformToInt($string) {
        // manca il controllo se vengono messe delle lettere
        if ($string == "") {
            return 0;
        } else {
            return intval($_GET['letter-a']);
        }
    }

?>