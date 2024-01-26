<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post">
        <label for="action">Action:</label><br>
        <input type="text" id="action" name="action"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
    // The json_encode() function is used to encode a value to JSON format.
    $jsonmess = '{
        "new":"che abbia inizio il game!!!",
        "lose":"HAI PERSO",
        "win":"HAI VINTO!!!",
        "noextract":"Non puoi più estrarre altre palline (digita check)",
        "moreextract": "Devi estrarre fino a 5 palline"
    }';

    $sequence = "45-50-1-70";

    //echo(rand(10, 100));
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        
        if (check_value($action)) {
            //var_dump($action);
            $dbname = "lotto";
            // Create connection
            $conn = new mysqli("localhost", "root", "", $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } else {
                $query = "SELECT COUNT(*) as num FROM estrazione";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                $count = $result->fetch_all(MYSQLI_ASSOC)[0]["num"];

                switch ($action) {
                    case "extract":
                        //code block
                        $randnum =  rand(1, 90);

                        //var_dump($randnum);

                        $query = "SELECT numero 
                        FROM estrazione 
                        WHERE numero = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $randnum);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $exist = count($result->fetch_all(MYSQLI_ASSOC));
                        //var_dump($result->fetch_all(MYSQLI_ASSOC));
                        //echo "".count($result->fetch_all(MYSQLI_ASSOC));

                        //var_dump($count);
                        if ($count == 5) {
                            $messages = json_decode($jsonmess);
                            echo "".$messages->noextract;
                        } else {
                            if ($exist == 0) {
                                $query = "SELECT MAX(id) as maxid FROM estrazione";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
    
                                $new_id = $result->fetch_all(MYSQLI_ASSOC)[0]["maxid"] + 1;
    
                                $query = "INSERT INTO estrazione (id, numero) VALUES (?,?)";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("ii", $new_id, $randnum);
                                $stmt->execute();
    
                                echo "hai pescato il numero: value ".$randnum;
                            } else {
                                echo "non è stato inserito niente perchè esisteva già nel DB";
                            }
                        }

                        break;
                    case "new":
                        
                        $query = "DELETE FROM estrazione";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();

                        $messages = json_decode($jsonmess);
                        echo "".$messages->new;

                        break;
                    case "check":
                        
                        if ($count == 5) {
                            $query = "SELECT * FROM estrazione";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
    
                            $your_sequence = $result->fetch_all(MYSQLI_ASSOC);
                            //var_dump($your_sequence);
    
                            $arr_seq = explode("-",$sequence);
    
                            foreach ($your_sequence as $num[0]) {
                                //var_dump($num[0]["numero"]);
                                if (!array_key_exists($num[0]["numero"],$arr_seq)) {
                                    check_exist_value($num[0]["numero"],$arr_seq,$jsonmess);
                                    break;
                                }
                            }
                        } else {
                            $messages = json_decode($jsonmess);
                            echo "".$messages->moreextract;
                        }

                        break;
                }
            }

        } else {
            echo "Inserisci un valore valido: 'extract' oppure 'new' oppure 'check'";
        }
    }
    
    // return true if you put only some values
    function check_value($value) {
        return ($value == "extract" || $value == "new" || $value == "check");
    }

    function check_exist_value ($value, $array, $json) {
        if (!array_key_exists($value ,$array)) {
            $messages = json_decode($json);
            echo "".$messages->lose;
        } else {
            $messages = json_decode($json);
            echo "".$messages->win;
        }
    }
?>