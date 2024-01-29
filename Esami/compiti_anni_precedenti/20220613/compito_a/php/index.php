<?php

    //echo "Michelis";
    $array = array("prova", "prova2");
    // json encode serve per creare un JSON partendo da un'array
    //json_encode($array);
    //$_REQUEST['q'] = $array;

    // get prende i valori passati dal JS passato nella variabile q
    var_dump($_GET['q']);

    // per passare la risposta da PHP a JS scrivi echo "valore che vuoi passare"
    echo "mando roba";
?>