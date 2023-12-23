<form action="#" method="GET">
    <h2>Esercizio PHP</h2>
    <ul>
        <li>
            <label for="letter-a">A: </label><input type="text" id="letter-a" name="letter-a" />
        </li>
        <li>
            <label for="letter-b">B: </label><input type="text" id="letter-b" name="letter-b" />
        </li>
        <li>
            <label for="letter-o">O: </label><input type="text" id="letter-o" name="letter-o" />
        </li>
        <li>
            <input type="submit" name="submit" value="Invia" />
        </li>
    </ul>
</form>

<?php
    // variable for DB
    $namedb = "giugno";
    $username = "root";
    $pw = "";
    $db = new mysqli("localhost" , $username, $pw, $namedb);

    // variable for TABLE
    $nametable = "insiemi";

    if ($db->connect_error) {
        // The die() function in PHP is used to print 
        // a message and terminate the current script execution.
        die("Connection Failed: " . $db->connect_error);
    } else {
        echo "Connection Success \n";

        // isset è una funzione per farti capire se è stata settata quella variabili nell'array
        if (isset($_GET['letter-a']) && isset($_GET['letter-b']) && isset($_GET['letter-o'])) {
            $A = transformToInt($_GET['letter-a']);
            $B = transformToInt($_GET['letter-b']);
            $allnumber = array($A, $B);
            $O = $_GET['letter-o'];

            $firstset = array();
            $secondset = array();
            $allset = array($firstset, $secondset);

            $finalset = array();

            // Controllo che le variabili passate siano NON nulle
            // e maggiori di zero
            if ( checkNumber($_GET['letter-a'], $_GET['letter-b']) && checkLetter($O) ) {
                
                for ($num = 0; $num < sizeof($allnumber, 0); $num++) {
                    $exist = "SELECT valore FROM insiemi WHERE insieme=?";
                
                    $stmt = $db->prepare($exist);
                    $stmt->bind_param('i', $allnumber[$num]);
                    $stmt->execute();
                    $result = $stmt->get_result();
            
                    $check = $result->fetch_all(MYSQLI_ASSOC);

                    $counter = 0;
                    foreach($check as $elem):
                        $allset[$num][$counter] = $elem["valore"];
                        $counter++;
                    endforeach;
                }
                
                switch($O) {
                    case "i":
                        $finalset = array_intersect($allset[0], $allset[1]);
                        break;
                    case "u":
                        $finalset = array_merge($allset[0], $allset[1]);
                        break;
                }

                // quello che verrà mostrato nella pagina web è l'array nuovo
                // con i valori dati dell'unione / intersezione degli insiemi
                echo " <- valori set finale" . var_dump($finalset);

                if (sizeof($finalset, 0) > 0) {
                    // max id of set ----------------------
                    $stmt = $db->prepare("SELECT MAX(insieme) AS maxid FROM insiemi");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $check = $result->fetch_all(MYSQLI_ASSOC);
                    $nameset = $check[0]['maxid'] + 1;
                    // ------------------------------------

                    foreach ($finalset as $elem):
                        // creating new id --------------------
                        $stmt = $db->prepare("SELECT COUNT(id) AS id FROM insiemi");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $check = $result->fetch_all(MYSQLI_ASSOC);
                        $newid = $check[0]['id'] + 1;
                        // ------------------------------------
                        // addition of new elem in DB ---------
                        $stmt = $db->prepare("INSERT INTO insiemi (id, valore, insieme) VALUES (?, ?, ?)");
                        $stmt->bind_param('iii', $newid, $elem, $nameset);
                        $stmt->execute();
                        // ------------------------------------
                    endforeach;

                    // clearing array
                    $finalset = array();
                }

            }
        }

    }

    function checkNumber($num1, $num2) {
        return ( $num1 > 0 && $num2 > 0 );
    }

    function checkLetter($letter) {
        return ( $letter == "i" || $letter == "u" );
    }

    function transformToInt($string) {
        // inval() trasforma i valori di stringhe in numeri, se uno mette una lettera come stringa ritornerà 0
        return intval($string);
    }
?>