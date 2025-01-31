<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentmarket";

// Crea connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Prendere i dati dal form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role']; // Ruolo selezionato

    // Controllo login
    $sql = "SELECT * FROM users WHERE email = '$email' AND role = '$role'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica della password
        if (password_verify($password, $row['password'])) {
            // Login riuscito, reindirizza l'utente alla pagina appropriata
            if ($role == 'buyer') {
                header("Location: ../html/shop.html"); // Pagina per compratori
            } else {
                header("Location: ../html/sell.html"); // Pagina per venditori
            }
            exit();
        } else {
            echo "Password errata!";
        }
    } else {
        echo "Nessun utente trovato con questa email e ruolo.";
    }
}

$conn->close();
?>
