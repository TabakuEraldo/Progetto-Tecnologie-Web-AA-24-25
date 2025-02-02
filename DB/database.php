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

    public function login($email){
        $query = $this->db->prepare("SELECT * FROM utenti WHERE email = ?");
        $email = mysqli_real_escape_string($this->db, $email);
        $query->bind_param('s', $email);
        $query->execute();
        return $query->get_result();
    }

    public function isAlreadyRegistered($email){
        $sql = "SELECT id FROM utenti WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $email = $this->db->real_escape_string($email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows;
    }

    public function registration($nome, $cognome, $email, $hashPass){
        $nome = $this->db->real_escape_string($nome);
        $cognome = $this->db->real_escape_string($cognome);
        $sql = "INSERT INTO `ecommercedb`.`utenti` (`email`, `nome`, `cognome`, `password`) VALUES (?, ?, ?, ?);";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $email, $nome, $cognome, $hashPass);
        return $stmt->execute();
    }

}
?>