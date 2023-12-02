<?php

//classe in cui vengono fatte le query sul database
class DatabaseHelper {
    private $db;

    //costruttore
    public function __construct($servername, $username, $password, $dbname) {
        $this->db = new mysqli($servername, $username, $password, $dbname);

        // controllo che non ci siano stati errori di connessione del database
        if ($this->db->connect_error) {
            die("Connection Failed: " . $db->connect_error);
        }
    }

    // n ti dice quanti post voglio nella Home
    public function getRandomPosts($n) {
        // variabile che contiene la query che stiamo preparando
        // nel nostro caso limitiamo (LIMIT) i risultati della select che sono solo 2
        $stmt = $this->db->prepare("SELECT idarticolo, titoloarticolo, imgarticolo FROM articolo ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i', $n);
        // per fare eseguire la nostra query
        $stmt->execute();
        // per ottenere il risultato della query
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories() {
        $stmt = $this->db->prepare("SELECT * FROM categoria");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // mettere quel uguale lì serve per mettere in parametro di Default nel caso uno chiamasse la funzione senza mettere nessun paramentro
    public function getPosts($idauthor=-1) {
        // viene fatto un controllo dove ci chiediamo se l'id autore esiste o meno
        $query = "SELECT idarticolo, titoloarticolo, imgarticolo, anteprimaarticolo, dataarticolo, nome FROM articolo, autore WHERE"
         . " autore=idautore ORDER BY dataarticolo DESC";
        if ($idauthor > 0) {
            $query .= " LIMIT ?";
        }

        $stmt = $this->db->prepare($query);

        if ($idauthor > 0) {
            $stmt->bind_param('i', $idauthor);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAuthors() {
        $query = "SELECT username, nome, GROUP_CONCAT(DISTINCT nomecategoria) as argomenti FROM categoria, articolo,"
         . " autore, articolo_ha_categoria WHERE idarticolo=articolo AND categoria=idcategoria AND autore=idautore"
         . " AND attivo=1 GROUP BY username, nome";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}

?>