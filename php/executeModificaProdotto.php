<?php
require_once 'start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = trim($_POST['nome']);
    $prezzo = trim($_POST['prezzo']);
    $categoria = trim($_POST['categoria']);
    $quantita = trim($_POST['disponibilita']);
    $descrizione = $_POST['descrizione'];
    $img;
    if(empty($_FILES['immagine']['name'])){
        $img = $_POST["immagine_attuale"];
    }
    else{
        $img = $_FILES['immagine']['name'];
    }
    
    if(empty($id) || empty($nome) || empty($prezzo) || empty($categoria) || empty($quantita) || empty($descrizione)){
        $errore = "Errore nella modifica del prodotto";
    }

    if ($db->modificaProdotto($id, $nome, $prezzo, $categoria, $quantita, $descrizione, $img)) {
        $_SESSION["confermaModifica"] = "Modifica avvenuta con successo";
        header("Location: manageProducts.php");
    } else {
        $errore = "Errore durante la modifica";
    }

    if(isset($error)){
        $_SESSION["errore"] = $error;
            header("Location: modificaProdotto.php?id=".$_GET["id"]);
    }
}
?>