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
    if(empty($_FILES['immagine']['name'])){
        $img = $_POST["immagine_attuale"];
    }
    else{
        $img = $_FILES['immagine']['name'];
    }
    
    if(empty($id)){
        $_SESSION["errore"] = "Errore durante la modifica";
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