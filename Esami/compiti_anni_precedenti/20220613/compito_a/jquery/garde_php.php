<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "20220613";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    };
    
    function check_solution($solution){
        for($y=0;$y<9;$y++){
            for($x=0;$x<9;$x++){
                $row=get_row($y,$solution);
                $col=get_col($x,$solution);
                $square=get_square($x,$y,$solution);
                for($i=1;$i<10;$i++){
                    if(
                        !(preg_match_all("/{$i}/i",$row)==1) ||
                        !(preg_match_all("/{$i}/i",$col)==1) ||
                        !(preg_match_all("/{$i}/i",$square)==1)
                    ){
                        return false;
                    }
                }
            }
        }
        return true;
    }

    function check_initial($solution){
        for($y=0;$y<9;$y++){
            for($x=0;$x<9;$x++){
                $row=get_row($y,$solution);
                $col=get_col($x,$solution);
                $square=get_square($x,$y,$solution);
                for($i=1;$i<10;$i++){
                    $onRow=preg_match_all("/{$i}/i",$row);
                    $onColumn=preg_match_all("/{$i}/i",$col);
                    $onSquare=preg_match_all("/{$i}/i",$square);
                    if(
                        !($onRow==1 || $onRow==0) ||
                        !($onColumn==1 || $onColumn==0) ||
                        !($onSquare==1 || $onSquare==0)
                    ){
                        return false;
                    }
                }
            }
        }
        return true;
    }

    function get_row($y,$map){
        $gameString="";
        for($x=0;$x<9;$x++){
            $gameString=$gameString."".$map[$y][$x];
        }
        return $gameString="";
    }

    function get_col($x,$map){
        $gameString="";
        for($y=0;$y<9;$y++){
            $gameString=$gameString."".$map[$y][$x];
        }
        return $gameString="";
    }

    function get_square($x,$y,$map){
        $x_square = $x%3;
        $x_start_index=$x_square*3;
        $x_end_index=$x_start_index+2;
        $y_square = $y%3;
        $y_start_index=$y_square*3;
        $y_end_index=$y_start_index+2;
        $gameString="";
        for($y_index=$y_start_index;$y_index<$y_end_index;$y_index++){
            for($x_index=$x_start_index;$x_index<$x_end_index;$x_index++){
                $gameString=$gameString."".$map[$y_index][$x_index];
            }
        }
        return $gameString;
    }

    function createStartingMatch() {
        $game = [];
        $gameString="";
        $noCharacterOnLine=rand(0,8); //becouse we need 8 character not 9
        for($i=0;$i<9;$i++){
            $game[$i]=[];
            $putCharacterOnCol=-1;
            if($i!=$noCharacterOnLine){
                $putCharacterOnCol=rand(0,8);
            }
            for($k=0;$k<9;$k++){
                if($k==$putCharacterOnCol){
                    $game[$i][$k]=rand(1,9);
                }else{
                    $game[$i][$k]="0";
                }
                $gameString=$gameString."".$game[$i][$k];
            }
        }
        if(check_initial($game)){
            return $gameString;
        } else {
            return createStartingMatch();
        }
    }
  
    if(isset($_POST["nuova_partita"])){
        $initial=createStartingMatch();
        $stmt = $conn->prepare("INSERT INTO sudoku (statoiniziale) VALUES (?)");
        $stmt->bind_param("s", $initial);
        $stmt->execute();
        //$_COOKIE['partita']=$conn->insert_id;
        echo json_encode($initial);
    }

    if(isset($_POST["partita"])){
        $partita=json_decode($_POST["partita"]);
        //var_dump($partita);
        echo json_encode(check_solution($partita));
    }
    
?>