<?php
//cosa cazzo succede se email o password non vanno bene?
require_once 'start.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $db->login($_POST['email']);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['user_id'] = $row["id"];
            $_SESSION['user_name'] = $row['nome'];
            $_SESSION['user_cognome'] = $row['cognome'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_role'] = $_POST['role'];
            require 'profile.php';            
        }
    }
}
?>

