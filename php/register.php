<?php
// Connessione al database
$servername = "localhost"; // Modifica con i tuoi dettagli
$username = "root"; // Modifica con i tuoi dettagli
$password = ""; // Modifica con i tuoi dettagli
$dbname = "studentmarket"; // Modifica con il nome del tuo database

// Crea connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Prendi i dati dal modulo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = $_POST['role']; // Prende il ruolo (buyer o seller)

    // Controllo se le password corrispondono
    if ($password !== $confirmPassword) {
        echo "Le password non corrispondono!";
        exit();
    }

    // Verifica se l'email è già registrata
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Questa email è già registrata!";
        exit();
    }

    // Criptare la password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Inserisci i dati dell'utente nel database
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$fullName', '$email', '$hashedPassword', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrazione completata con successo! <a href='../html/login.html'>Accedi ora</a>";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
