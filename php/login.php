<?php
session_start();

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
    $role = $_POST['role']; // Ruolo scelto (buyer o seller)

    // Controllo login
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica della password
        if (password_verify($password, $row['password'])) {
            // Login riuscito, salva i dati della sessione
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_role'] = $role;  // Salva il ruolo selezionato nella sessione

            // Reindirizza alla pagina appropriata in base al ruolo
            if ($role == 'buyer') {
                header("Location: ../html/profile.php"); // Pagina per compratori
            } else {
                header("Location: ../html/profile.php"); // Pagina per venditori
            }
            exit();
        } else {
            echo "Password errata!";
        }
    } else {
        echo "Nessun utente trovato con questa email.";
    }

    $conn->close();
}
?>

