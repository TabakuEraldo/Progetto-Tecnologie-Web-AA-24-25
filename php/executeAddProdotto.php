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
    $img;

    if (!empty($_FILES['immagine']['name'])) {
        $imgName = $_FILES['immagine']['name'];
        $imgTmpName = $_FILES['immagine']['tmp_name'];
        $imgSize = $_FILES['immagine']['size'];
        $imgError = $_FILES['immagine']['error'];
        $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imgExt, $allowedExts)) {
            $_SESSION["errore"] = "Tipo di file non valido. Sono ammessi solo JPG, JPEG, PNG e GIF!";
            header("Location: addProdotto.php");
            exit();
        }
        if ($imgError !== 0) {
            $_SESSION["errore"] = "Errore nel caricamento dell'immagine. Riprova!";
            header("Location: addProdotto.php");
            exit();
        }
        if ($imgSize > 5 * 1024 * 1024) {
            $_SESSION["errore"] = "Il file è troppo grande! La dimensione massima consentita è 5MB.";
            header("Location: addProdotto.php");
            exit();
        }
        $imgNewName = uniqid('', true) . "." . $imgExt;
        $imgDestination = "../img/" . $imgNewName;
        if (!move_uploaded_file($imgTmpName, $imgDestination)) {
            $_SESSION["errore"] = "Errore durante il salvataggio dell'immagine. Riprova più tardi.";
            header("Location: addProdotto.php");
            exit();
        }
        $img = $imgNewName;
    } else {
        $_SESSION["errore"] = "L'immagine del prodotto è obbligatoria!";
        header("Location: addProdotto.php");
        exit();
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