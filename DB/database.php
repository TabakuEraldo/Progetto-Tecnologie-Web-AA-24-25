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
        $query = $this->db->prepare("SELECT id, nome, immagine, prezzo, disponibilita, descrizione FROM prodotti 
                                     WHERE disponibilita > 0
                                     ORDER BY RAND() LIMIT ?");
        $query->bind_param('i', $number);
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

    public function registration($nome, $cognome, $email, $hashedPassword, $profileImage) {
        $stmt = $this->db->prepare("INSERT INTO utenti (nome, cognome, email, password, imgProfilo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nome, $cognome, $email, $hashedPassword, $profileImage);  
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getConnection(){
        return $this->db;
    }

    public function searchProducts($keyword) {
        $query = $this->db->prepare("SELECT id, nome, immagine, prezzo, disponibilita, descrizione FROM prodotti WHERE nome LIKE ? OR descrizione LIKE ?");
        if (!$query) {
            die("Errore nella preparazione della query: " . $this->db->error);
        }
        $searchTerm = "%".$keyword."%";
        $query->bind_param("ss", $searchTerm, $searchTerm);
        $query->execute();
        
        $result = $query->get_result();
        
        if (!$result) {
            die("Errore nell'esecuzione della query: " . $query->error);
        }
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotifications($userID, $userRole) {
        if($userRole == "buyer"){
            $query = $this->db->prepare("SELECT notifiche.* FROM notifiche JOIN utenti ON notifiche.id_Utente = utenti.id WHERE utenti.id = ? AND notifiche.id_Acquisto IS NOT NULL ORDER BY notifiche.id DESC");
            $query->bind_param("i", $userID);
            $query->execute();
            $result = $query->get_result();
            if (!$result) {
                die("Errore nell'esecuzione della query: " . $query->error);
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        else if($userRole == "seller"){
            $query = $this->db->prepare("SELECT notifiche.* FROM notifiche JOIN utenti ON notifiche.id_Utente = utenti.id WHERE utenti.id = ? AND notifiche.id_Acquisto IS NULL ORDER BY notifiche.id DESC");
            $query->bind_param("i", $userID);
            $query->execute();
            $result = $query->get_result();
            if (!$result) {
                die("Errore nell'esecuzione della query: " . $query->error);
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        else{
            die("Errore nel ruolo");
        }
    }

    public function readNotification($id) {
        $query = $this->db->prepare("SELECT * FROM notifiche WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        $query = $this->db->prepare("UPDATE `ecommercedb`.`notifiche` SET `isLetto` = '1' WHERE (`id` = ?);");
        $query->bind_param("i", $id);
        $query->execute();
        return $result;
    }

    public function getListino($userId) {
        $query = $this->db->prepare("SELECT prodotti.* FROM listini JOIN prodottiinlistino ON listini.id = prodottiinlistino.id_listino JOIN prodotti ON prodottiinlistino.id_prodotto = prodotti.id WHERE listini.id_utente = ? ORDER BY disponibilita DESC");
        $query->bind_param("i", $userId);
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getProdotto($prodId) {
        $query = $this->db->prepare("SELECT * FROM prodotti WHERE id = ?");
        $query->bind_param("i", $prodId);
        $query->execute();
        return $query->get_result()->fetch_assoc();
    }

    public function modificaProdotto($id, $nome, $prezzo, $categoria, $quantita, $descrizione, $img) {
        $query = $this->db->prepare("UPDATE `ecommercedb`.`prodotti` SET `nome` = ?, `immagine` = ?, `categoria` = ?, `prezzo` = ?, `descrizione` = ?, `disponibilita` = ? WHERE (`id` = ?);");
        $query->bind_param("sssdsii", $nome, $img, $categoria, $prezzo, $descrizione, $quantita, $id);
        return $query->execute();
    }

    public function addProdotto($nome, $prezzo, $categoria, $quantita, $descrizione, $img, $userid) {
        $query = $this->db->prepare("INSERT INTO `ecommercedb`.`prodotti` (`nome`, `immagine`, `categoria`, `prezzo`, `descrizione`, `disponibilita`) VALUES (?, ?, ?, ?, ?, ?);");
        $query->bind_param("sssdsi", $nome, $img, $categoria, $prezzo, $descrizione, $quantita);
    
        if ($query->execute()) {
            $prodId = $this->db->insert_id;
            $query = $this->db->prepare("SELECT id FROM ecommercedb.listini WHERE id_Utente = ?");
            $query->bind_param("i", $userid);
            $query->execute();
            $result = $query->get_result();
            $listRow = $result->fetch_assoc(); 
            if ($listRow) {
                $listId = $listRow['id'];
                $query = $this->db->prepare("INSERT INTO `ecommercedb`.`prodottiinlistino` (`id_Listino`, `id_Prodotto`) VALUES (?, ?);");
                $query->bind_param("ii", $listId, $prodId);
                return $query->execute();
            } else {
                $query = $this->db->prepare("INSERT INTO `ecommercedb`.`listini` (`id_Utente`) VALUES (?);");
                $query->bind_param("i", $userid);
                if ($query->execute()) {
                    $listId = $this->db->insert_id;
                    $query = $this->db->prepare("INSERT INTO `ecommercedb`.`prodottiinlistino` (`id_Listino`, `id_Prodotto`) VALUES (?, ?);");
                    $query->bind_param("ii", $listId, $prodId);
                    return $query->execute();
                }
            }
        }
        return false;
    }

    public function getStoricoVendite($userId) {
        $query = $this->db->prepare("SELECT venditaprodotti.quantita, prodotti.nome, prodotti.prezzo, prodotti.immagine, prodotti.categoria FROM ecommercedb.venditaprodotti JOIN prodotti ON prodotti.id = venditaprodotti.id_Prodotto JOIN vendite ON venditaprodotti.id_Vendita = vendite.id WHERE vendite.id_Utente = ? ORDER BY venditaprodotti.id DESC;");
        $query->bind_param("i", $userId);
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getStoricoAcquisti($userId) {
        $query = $this->db->prepare("SELECT acquistoprodotti.quantita, prodotti.nome, prodotti.prezzo, prodotti.immagine, prodotti.categoria FROM ecommercedb.acquistoprodotti JOIN prodotti ON prodotti.id = acquistoprodotti.id_Prodotto JOIN acquisti ON acquisti.id = acquistoprodotti.id_Acquisto WHERE acquisti.id_Utente = ? ORDER BY acquistoprodotti.id DESC;");
        $query->bind_param("i", $userId);
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getVenditoreByIdProdotto($idProdotto) {
        $query = $this->db->prepare("SELECT utenti.id FROM ecommercedb.utenti JOIN listini ON utenti.id = listini.id_Utente JOIN prodottiinlistino ON listini.id = prodottiinlistino.id_Listino JOIN prodotti ON prodotti.id = prodottiinlistino.id_Prodotto WHERE prodotti.id = ?");
        $query->bind_param("i", $idProdotto);
        $query->execute();
        return $query->get_result()->fetch_assoc();
    }

    public function addVendita($userId, $idProdotto, $quantita) {
        $query = $this->db->prepare("INSERT INTO `ecommercedb`.`vendite` (`id_Utente`) VALUES (?);");
        $query->bind_param("i", $userId);
        $query->execute();
        $venditaId = $this->db->insert_id;
        $query = $this->db->prepare("INSERT INTO `ecommercedb`.`venditaprodotti` (`id_Vendita`, `id_Prodotto`, `quantita`) VALUES (?, ?, ?);");
        $query->bind_param("iii", $venditaId, $idProdotto, $quantita);
        $query->execute();
        return $venditaId;
    }

    public function notificaAcquisto($acquistoId, $titolo, $testo, $userId) {
        $query = $this->db->prepare("INSERT INTO `ecommercedb`.`notifiche` (`titolo`, `testo`, `id_Utente`, `id_Acquisto`) VALUES (?, ?, ?, ?);");
        $query->bind_param("ssii", $titolo, $testo, $userId, $acquistoId);
        return $query->execute();
    }

    public function notificaVendita($venditaId, $titolo, $testo, $userId) {
        $query = $this->db->prepare("INSERT INTO `ecommercedb`.`notifiche` (`titolo`, `testo`, `id_Utente`, `id_Vendita`) VALUES (?, ?, ?, ?);");
        $query->bind_param("ssii", $titolo, $testo, $userId, $venditaId);
        return $query->execute();
    }

    public function notificaFineProdotto($prodottoId, $titolo, $testo, $userId) {
        $query = $this->db->prepare("INSERT INTO `ecommercedb`.`notifiche` (`titolo`, `testo`, `id_Utente`, `id_Prodotto`) VALUES (?, ?, ?, ?);");
        $query->bind_param("ssii", $titolo, $testo, $userId, $prodottoId);
        return $query->execute();
    }
}
?>