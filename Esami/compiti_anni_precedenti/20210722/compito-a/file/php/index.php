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
                switch ($action) {
                    case "extract":
                        //code block
                        $randnum =  rand(1, 90);

                        var_dump($randnum);

                        $query = "SELECT numero 
                        FROM estrazione 
                        WHERE numero = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $randnum);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        //var_dump($result->fetch_all(MYSQLI_ASSOC));
                        echo "".count($result->fetch_all(MYSQLI_ASSOC));
                        break;
                    case "new":
                        //code block;
                        break;
                    case "check":
                        //code block
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
?>