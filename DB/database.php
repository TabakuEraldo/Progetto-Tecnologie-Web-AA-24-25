<?php
class DataBase{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed");
        }        
    }

    public function getRandomProduct($number){
        $query = $this->db->prepare("SELECT nome, immagine, prezzo, disponibilita, descrizione FROM prodotti ORDER BY RAND() LIMIT ?");
        $query->bind_param('i',$number);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function login($email, $password){
        $query = $this->db->prepare("SELECT * FROM utenti WHERE email = ?");
        $email = mysqli_real_escape_string($this->db, $email);
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return $result->fetch_assoc();
            }
        }
        return null;
    }

}
?>