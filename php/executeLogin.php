<?php
session_start();
require_once 'start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $result = $db->login($email);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row["id"];
            $_SESSION['user_name'] = $row['nome'];
            $_SESSION['user_cognome'] = $row['cognome'];
            $_SESSION['user_indirizzo'] = $row['indirizzo'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_role'] = $_POST['role']; 
            $_SESSION['user_img'] = $row['imgProfilo']; 
            require "profile.php";
            exit();
        } else {
            $error_message = "⚠️ Password errata.";
        }
    } else {
        $error_message = "⚠️ Email non trovata.";
    }
}
?>


<?php if (isset($error_message)): ?>
    <div class="alert alert-danger text-center">
        <?php echo htmlspecialchars($error_message); ?>
    </div>
<?php endif; ?>


