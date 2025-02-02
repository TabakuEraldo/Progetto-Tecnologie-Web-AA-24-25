<?php
require_once 'start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['fullName']);
    $cognome = trim($_POST['cognome']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($nome) || empty($email) || empty($password) || empty($confirmPassword)|| empty($cognome)) {
        die("Tutti i campi sono obbligatori!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Formato email non valido!");
    }

    if ($password !== $confirmPassword) {
        die("Le password non corrispondono!");
    }

    if($db->isAlreadyRegistered($email) > 0){
        die("Esiste già un account con questa email!");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($db->registration($nome, $cognome, $email, $hashedPassword)) {
        echo "<script>
                alert('Registrazione completata con successo! Ora puoi accedere.');
                window.location.href = 'login.php';
              </script>";
    } else {
        die("Errore durante la registrazione");
    }
}
?>
