<?php

    //$array = array("prova", "prova2");
    // json encode serve per creare un JSON partendo da un'array
    //json_encode($array);

    // get prende i valori passati dal JS passato nella variabile 'message'
    //var_dump($_GET['message']);

    $dbname = "esami";
    // Create connection
    $conn = new mysqli("localhost", "root", "", $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } else {
        //echo "Connection Success";
        if ($_GET['message'] == "new_game") {
            //echo "New game starto";
            $query = "SELECT * FROM sudoku";
            // prepare and bind
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $status = $result->fetch_all(MYSQLI_ASSOC)[0];

            // json encode serve per creare un JSON partendo da un'array
            $json_status = json_encode($status);
            // qui mando al JS il JSON creato
            echo "".$json_status;
        }
    }

    // per passare la risposta da PHP a JS scrivi echo "valore che vuoi passare"
    //echo "mando roba";
?>