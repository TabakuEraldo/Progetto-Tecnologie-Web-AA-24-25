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
    $id = $_SESSION['user_id'];
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $indirizzo = trim($_POST['indirizzo']);
    $email = trim($_POST['email']);
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
            header("Location: profile.php");
            exit();
        }
        if ($imgError !== 0) {
            $_SESSION["errore"] = "Errore nel caricamento dell'immagine. Riprova!";
            header("Location: profile.php");
            exit();
        }
        if ($imgSize > 5 * 1024 * 1024) {
            $_SESSION["errore"] = "Il file è troppo grande! La dimensione massima consentita è 5MB.";
            header("Location: profile.php");
            exit();
        }
        $imgNewName = uniqid('', true) . "." . $imgExt;
        $imgDestination = "../img/" . $imgNewName;
        if (!move_uploaded_file($imgTmpName, $imgDestination)) {
            $_SESSION["errore"] = "Errore durante il salvataggio dell'immagine. Riprova più tardi.";
            header("Location: profile.php");
            exit();
        }
        $img = $imgNewName;
    } else {
        $img = $_POST["immagine_attuale"];
    }


    if ($db->modificaProfiloGenerale($id, $nome, $cognome, $email, $indirizzo, $img)) {
        $_SESSION['user_name'] = $nome;
        $_SESSION['user_cognome'] = $cognome;
        $_SESSION['user_indirizzo'] = $indirizzo;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_img'] = $img;
        $_SESSION["confermaModificaProf"] = "Profilo modificato con successo";
    } else {
        $_SESSION["errore"] = "Errore durante la modifica";
    }

    header("Location: profile.php");
}
?>