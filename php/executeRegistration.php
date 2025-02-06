<?php
require_once 'start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['fullName']);
    $cognome = trim($_POST['cognome']);
    $email = trim($_POST['email']);
    $indirizzo = trim($_POST['indirizzo']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($nome) || empty($email) || empty($password) || empty($confirmPassword) || empty($cognome) || empty($indirizzo)) {
        $errore = "Tutti i campi sono obbligatori!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errore = "Formato email non valido!";
    }

    if ($password !== $confirmPassword) {
        $errore = "Le password non corrispondono!";
    }

    if ($db->isAlreadyRegistered($email) > 0) {
        $errore = "Esiste già un account con questa email!";
    }

    $profileImage = null;
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['profileImage']['tmp_name'];
        $fileName = $_FILES['profileImage']['name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($fileExt), $allowedExtensions)) {
            $profileImage = 'profile_' . time() . '.' . $fileExt;
            $uploadDir = '../img/';
            $uploadFile = $uploadDir . $profileImage;

            if (!move_uploaded_file($tmpName, $uploadFile)) {
                $errore = "Errore nel caricamento dell'immagine!";
            }
        } else {
            $errore = "Formato immagine non supportato!";
        }
    } else {
        $profileImage = 'default.png';
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($db->registration($nome, $cognome, $email, $indirizzo, $hashedPassword, $profileImage)) {
        $_SESSION["confermaRegistrazione"] = "Registrazione avvenuta con successo";
        header("Location: login.php");
    } else {
        $errore = "Errore durante la registrazione";
    }

    if(isset($error)){
        $_SESSION["errore"] = $error;
            header("Location: register.php");
    }
}
?>
