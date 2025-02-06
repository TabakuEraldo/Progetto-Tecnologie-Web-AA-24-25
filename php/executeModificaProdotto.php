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


    if (!empty($_FILES['immagine']['name'])) {
        $imgName = $_FILES['immagine']['name'];
        $imgTmpName = $_FILES['immagine']['tmp_name'];
        $imgSize = $_FILES['immagine']['size'];
        $imgError = $_FILES['immagine']['error'];
        $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imgExt, $allowedExts)) {
            $_SESSION["errore"] = "Tipo di file non valido. Sono ammessi solo JPG, JPEG, PNG, GIF e WEBP!";
            header("Location: modificaProdotto.php?id=".$_GET["id"]);
            exit();
        }
        if ($imgError !== 0) {
            $_SESSION["errore"] = "Errore nel caricamento dell'immagine. Riprova!";
            header("Location: modificaProdotto.php?id=".$_GET["id"]);
            exit();
        }
        if ($imgSize > 5 * 1024 * 1024) {
            $_SESSION["errore"] = "Il file è troppo grande! La dimensione massima consentita è 5MB.";
            header("Location: modificaProdotto.php?id=".$_GET["id"]);
            exit();
        }
        $imgNewName = uniqid('', true) . "." . $imgExt;
        $imgDestination = "../img/" . $imgNewName;
        if (!move_uploaded_file($imgTmpName, $imgDestination)) {
            $_SESSION["errore"] = "Errore durante il salvataggio dell'immagine. Riprova più tardi.";
            header("Location: modificaProdotto.php?id=".$_GET["id"]);
            exit();
        }
        $img = $imgNewName;
    } else {
        $img = $_POST["immagine_attuale"];
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