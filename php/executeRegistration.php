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
        $img = $_FILES['profileImage']['name'];
    } else {
        $img = "default.png";
    }

    if (empty($nome) || empty($email) || empty($password) || empty($confirmPassword) || empty($cognome) || empty($indirizzo)) {
        $_SESSION["errore"] = "Tutti i campi sono obbligatori!";
        header("Location: register.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["errore"] = "Formato email non valido!";
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirmPassword) {
        $_SESSION["errore"] = "Le password non corrispondono!";
        header("Location: register.php");
        exit();
    }

    if ($db->isAlreadyRegistered($email) > 0) {
        $_SESSION["errore"] = "Esiste già un account con questa email!";
        header("Location: register.php");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($db->registration($nome, $cognome, $email, $indirizzo, $hashedPassword, $img)) {
        $_SESSION["confermaRegistrazione"] = "Registrazione avvenuta con successo!";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION["errore"] = "Errore durante la registrazione. Riprova più tardi.";
        header("Location: register.php");
        exit();
    }
}
?>