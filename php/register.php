<?php
// Connessione al database
$servername = "localhost"; // Modifica con i tuoi dettagli
$username = "root"; // Modifica con i tuoi dettagli
$password = ""; // Modifica con i tuoi dettagli
$dbname = "studentmarket"; // Modifica con il nome del tuo database

$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo connessione
if ($conn->connect_error) {
    die("Errore di connessione al database: " . $conn->connect_error);
}

// Prendi i dati dal modulo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Controllo se i campi sono vuoti
    if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
        die("Tutti i campi sono obbligatori!");
    }

    // Protezione contro SQL Injection
    $fullName = $conn->real_escape_string($fullName);
    $email = $conn->real_escape_string($email);

    // Controllo formato email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Formato email non valido!");
    }

    // Controllo se le password corrispondono
    if ($password !== $confirmPassword) {
        die("Le password non corrispondono!");
    }

    // Verifica se l'email è già registrata
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Questa email è già registrata!");
    }

    $stmt->close();

    // Criptare la password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Inserisci i dati nel database con prepared statements (sicuro contro SQL Injection)
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $fullName, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>
                alert('Registrazione completata con successo! Ora puoi accedere.');
                window.location.href = '../html/login.html';
              </script>";
    } else {
        die("Errore durante la registrazione: " . $conn->error);
    }

    $stmt->close();
}

$conn->close();
?>
