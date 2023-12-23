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
    // variable for DB
    $namedb = "giugno";
    $username = "root";
    $pw = "";
    $db = new mysqli("localhost" , $username, $pw, $namedb);

    // variable for TABLE
    $nametable = "insiemi";

    if ($db->connect_error) {
        // The die() function in PHP is used to print 
        //a message and terminate the current script execution.
        die("Connection Failed: " . $db->connect_error);
    } else {
        echo "Connection Success \n";
        // isset è una funzione per farti capire se è stata settata quella variabili nell'array
        /*
        if (isset($_GET['letter-a'])) {
            $A = transformToInt($_GET['letter-a']);
        }
        */

        //$letters = array($A, $B, $C);

        // Controllo che le variabili passate siano NON nulle
        // e maggiori di zero
        if (isset($_GET['letter-a']) && isset($_GET['letter-b']) && isset($_GET['letter-c'])) {
            $A = transformToInt($_GET['letter-a']);
            $B = transformToInt($_GET['letter-b']);
            $allnumber = array($A, $B);
            $C = $_GET['letter-c']; // da fare il check se viene passato un numero
            //echo "Hai inserito una i oppure u: " . var_dump(checkLetter($C));

            $firstset = array();
            $secondset = array();
            $allset = array($firstset, $secondset);

            $finalset = array();

            if ( checkNumber($_GET['letter-a'], $_GET['letter-b']) && checkLetter($C) ) {
                
                for ($num = 0; $num < sizeof($allnumber, 0); $num++) {
                    //var_dump($allnumber[$num]);
                    $exist = "SELECT valore FROM insiemi WHERE insieme=?";
                
                    $stmt = $db->prepare($exist);
                    $stmt->bind_param('i', $allnumber[$num]);
                    $stmt->execute();
                    $result = $stmt->get_result();
            
                    $check = $result->fetch_all(MYSQLI_ASSOC);

                    $counter = 0;
                    foreach($check as $elem):
                        //var_dump($elem["valore"]);
                        $allset[$num][$counter] = $elem["valore"];
                        $counter++;
                    endforeach;
                }
                
                //var_dump($allset);
                //echo var_dump($check[0]["COUNT(insieme)"] > 0);
                switch($C) {
                    case "i":
                        $finalset = array_intersect($allset[0], $allset[1]);
                        break;
                    case "u":
                        // sizeof(array, mode)
                        // array	Required. Specifies the array
                        // mode	Optional. Specifies the mode. Possible values:
                        // 0 - Default. Does not count all elements of multidimensional arrays
                        // 1 - Counts the array recursively (counts all the elements of multidimensional arrays)
                        //$lenght = sizeof($allset, 1);
                        //$counter = 0;
                        //echo "Lunghezza della allset: " . $lenght;
                        /*
                        foreach($allset as $vet):
                            foreach($vet as $elem):
                                //var_dump($elem);
                                $finalset[$counter] = $elem;
                                $counter++;
                            endforeach;
                        endforeach;
                        */
                        $finalset = array_merge($allset[0], $allset[1]);
                        break;
                }

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