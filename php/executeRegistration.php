<?php
require_once 'start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $email = strtolower(trim($_POST['email']));
    $indirizzo = trim($_POST['indirizzo']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $img;

    if (!empty($_FILES['profileImage']['name'])) {
        $imgName = $_FILES['profileImage']['name'];
        $imgTmpName = $_FILES['profileImage']['tmp_name'];
        $imgSize = $_FILES['profileImage']['size'];
        $imgError = $_FILES['profileImage']['error'];
        $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

        $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imgExt, $allowedExts)) {
            $pageParams["errore"] = "Tipo di file non valido. Sono ammessi solo JPG, JPEG, PNG, GIF e WEBP!";
            header("Location: register.php");
            exit();
        }
        if ($imgError !== 0) {
            $pageParams["errore"] = "Errore nel caricamento dell'immagine. Riprova!";
            header("Location: register.php");
            exit();
        }
        if ($imgSize > 5 * 1024 * 1024) {
            $pageParams["errore"] = "Il file è troppo grande! La dimensione massima consentita è 5MB.";
            header("Location: register.php");
            exit();
        }
        $imgNewName = uniqid('', true) . "." . $imgExt;
        $imgDestination = "../img/" . $imgNewName;
        if (!move_uploaded_file($imgTmpName, $imgDestination)) {
            $pageParams["errore"] = "Errore durante il salvataggio dell'immagine. Riprova più tardi.";
            header("Location: register.php");
            exit();
        }
        $img = $imgNewName;
    } else {
        $img = "default.png";
    }

    if (empty($nome) || empty($email) || empty($password) || empty($confirmPassword) || empty($cognome) || empty($indirizzo)) {
        $pageParams["errore"] = "Tutti i campi sono obbligatori!";
        header("Location: register.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pageParams["errore"] = "Formato email non valido!";
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirmPassword) {
        $pageParams["errore"] = "Le password non corrispondono!";
        header("Location: register.php");
        exit();
    }

    if ($db->isAlreadyRegistered($email) > 0) {
        $pageParams["errore"] = "Esiste già un account con questa email!";
        header("Location: register.php");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($db->registration($nome, $cognome, $email, $indirizzo, $hashedPassword, $img)) {
        $pageParams["confermaRegistrazione"] = "Registrazione avvenuta con successo!";
        header("Location: login.php");
        exit();
    } else {
        $pageParams["errore"] = "Errore durante la registrazione. Riprova più tardi.";
        header("Location: register.php");
        exit();
    }
}
?>