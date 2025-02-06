<?php
require_once 'start.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['user_id'];
    $passAtt = $_POST['passwordAttuale'];
    $nuovaPass = $_POST['passwordNuova'];
    $confermaPass = $_POST['confermaNuova'];
    
    if(empty($id)){
        $_SESSION["errore"] = "Errore nella modifica della password";
    }

    if(password_verify($passAtt, $db->getPassByID($id)["password"])){
        if ($nuovaPass === $confermaPass) {
            $hashedPassword = password_hash($nuovaPass, PASSWORD_DEFAULT);
            if($db->modificaPass($id, $hashedPassword)){
                $_SESSION["confermaModificaPass"];
            }
            else{
                $_SESSION["errore"] = "Errore nella modifica della password";
            }
        }
        else{
            $_SESSION["errore"] = "Errore nella modifica della password";
        }
    }
    else
    {
        $_SESSION["errore"] = "Errore nella modifica della password";
    }

    header("Location: modificaProfilo.php");
}
?>