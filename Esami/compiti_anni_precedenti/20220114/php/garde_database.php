<?php
    class DatabaseHelper {
        private $db;

        public function __construct($serverName,$userName,$password,$dbName){
            $this->db = new mysqli($serverName,$userName,$password,$dbName);
            /*
            if($this->db->connet_error){
                die("Connection Failed: ".$db->connect_error);
            }
            */
            
        }

        public function addCitizen($nome,$cognome,$codice_fiscale,$data_di_nascita,$sesso){
            $stmt = $this->db->prepare("INSERT INTO `cittadino`(`nome`, `cognome`, `codicefiscale`, `datanascita`, `sesso`) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssss",$nome,$cognome,$codice_fiscale,$data_di_nascita,$sesso);
            $stmt->execute();
        }

        public function getCitizen($id){
            $stmt = $this->db->prepare("SELECT * FROM `cittadino` WHERE idcittadino=?");
            $stmt->bind_param("s",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getAllCitizen(){
            $stmt = $this->db->prepare("SELECT * FROM `cittadino`");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    $dbh = new DatabaseHelper("localhost","root","","20220114");

?>