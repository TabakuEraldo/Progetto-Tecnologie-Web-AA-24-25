<?php
require_once 'start.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $prezzo = trim($_POST['prezzo']);
    $categoria = trim($_POST['categoria']);
    $quantita = trim($_POST['disponibilita']);
    $descrizione = $_POST['descrizione'];
    $img = $_FILES['immagine']['name'];

    if(empty($nome) || empty($prezzo) || empty($categoria) || empty($quantita) || empty($descrizione) || empty($img)){
        $error = "Tutti i campi vanno riempiti";
    }

    if ($db->addProdotto($nome, $prezzo, $categoria, $quantita, $descrizione, $img, $_SESSION['user_id'])) {
        $_SESSION["confermaAddProdotto"] = "Prodotto aggiunto con successo";
        header("Location: manageProducts.php");
    } else {
        $error = "Errore durante l'aggiunta";
    }
}

if(isset($error)){
    $_SESSION["errore"] = $error;
        header("Location: addProdotto.php");
}
?>